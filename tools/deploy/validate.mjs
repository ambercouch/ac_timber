#!/usr/bin/env node
import { createRequire } from 'node:module';
import { mkdir, writeFile, readFile } from 'node:fs/promises';
import { createHash } from 'node:crypto';
import path from 'node:path';
import os from 'node:os';
import { requestFingerprint, diagnosticUrl, classifyCookieControlDiagnostics, unexpectedDiagnostics } from './validation-baseline.mjs';
const baseline = process.argv.includes('--baseline');
const [url, outputDir, manifestPath] = process.argv.slice(2).filter(a => a !== '--baseline');
if (url !== 'https://dev.businesstranslated.com' || !outputDir) throw Error('Usage: node validate.mjs https://dev.businesstranslated.com <output-dir> [manifest.json]');
if (Number(process.versions.node.split('.')[0]) !== 24) throw Error('Use Node 24 for browser validation');
const require = createRequire(path.join(process.env.BTL_BROWSER_TOOL_DIR || path.join(os.homedir(), 'Tools/ac-timber-browser'), 'package.json'));
const { chromium } = require('playwright');
await mkdir(outputDir, { recursive: true });
const manifest = manifestPath ? JSON.parse(await readFile(manifestPath, 'utf8')) : null;
const browser = await chromium.launch({ headless: true });
const reports = [];
const httpCredentials = process.env.BTL_HTTP_USERNAME && process.env.BTL_HTTP_PASSWORD
  ? { username: process.env.BTL_HTTP_USERNAME, password: process.env.BTL_HTTP_PASSWORD } : undefined;
try {
  for (const [width, height] of [[390,844],[840,1000],[999,1000],[1000,1000],[1440,1000]]) {
    const page = await browser.newPage({ viewport: {width,height}, httpCredentials });
    page.setDefaultTimeout(10000);
    const report = {width,height,console:[],jsErrors:[],failedRequests:[],httpErrors:[],failures:[]};
    const check = (ok, message) => { if (!ok) report.failures.push(message); };
    page.on('console', m => {
      if (['warning','error'].includes(m.type())) {
        const location = m.location();
        report.console.push({type:m.type(), text:m.text(), url:diagnosticUrl(location.url),
          requestFingerprint:requestFingerprint(location.url), line:location.lineNumber, column:location.columnNumber});
      }
    });
    page.on('pageerror', e => report.jsErrors.push(String(e)));
    page.on('requestfailed', r => report.failedRequests.push({url:r.url().split('?')[0], error:r.failure()?.errorText}));
    page.on('response', r => { if (r.status() >= 400) report.httpErrors.push({status:r.status(),
      url:diagnosticUrl(r.url()), requestFingerprint:requestFingerprint(r.url()), resourceType:r.request().resourceType()}); });
    try {
      report.status = (await page.goto(url, {waitUntil:'networkidle',timeout:60000})).status();
      check(report.status === 200, 'Document must return HTTP 200');
      if (report.status !== 200) {
        await page.screenshot({path:path.join(outputDir,`${width}-unavailable.png`)});
        throw Error('Page unavailable; layout and menu validation skipped');
      }
      check(new URL(page.url()).origin === url, 'Unexpected redirect origin');
      report.toggleVisible = await page.locator('#menuButton').isVisible();
      check(report.toggleVisible === (width < 1000), 'Incorrect toggle visibility');
      report.overflow = await page.evaluate(() => document.documentElement.scrollWidth > innerWidth);
      check(!report.overflow, 'Horizontal overflow');
      const sheet = await page.locator('link[href*="/themes/ac_timber/style.css"]').getAttribute('href');
      const css = await page.request.get(new URL(sheet, url).href);
      check(css.status() === 200, 'Stylesheet request failed');
      report.cssSha256 = createHash('sha256').update(await css.body()).digest('hex');
      report.stylesheetUrl = new URL(sheet, url).href;
      if (!baseline) check(new URL(sheet, url).searchParams.get('ver') === report.cssSha256, 'Stylesheet URL version differs from CSS contents');
      if (manifest) check(report.cssSha256 === manifest.assets['style.css'], 'Public CSS differs from release; check caches/CDN transforms');
      await page.evaluate(async () => {
        for(let y=0;y<document.body.scrollHeight;y+=700) {scrollTo(0,y); await new Promise(r=>setTimeout(r,75));}
        scrollTo(0,0);
      });
      await page.screenshot({path:path.join(outputDir,`${width}-closed.png`),fullPage:true});
      if(width < 1000) {
        report.barColor = await page.locator('.c-burger__bar--tl').evaluate(e=>getComputedStyle(e).backgroundColor);
        if (!baseline) check(report.barColor === 'rgb(31, 78, 74)', 'Closed bars must be deep teal');
        await page.locator('#menuButton').click();
        await page.waitForTimeout(450);
        check(await page.locator('#mobileNavigation').getAttribute('data-state') === 'on', 'Menu did not open');
        report.links = await page.locator('#mobileNavigation a:visible').count();
        check(report.links > 0, 'No visible mobile menu links');
        for (const link of await page.locator('#mobileNavigation a:visible').all()) {
          check(!!(await link.getAttribute('href')), 'Empty menu link');
        }
        await page.screenshot({path:path.join(outputDir,`${width}-open.png`)});
        await page.locator('#menuButton').click();
        await page.waitForTimeout(450);
        check(await page.locator('#mobileNavigation').getAttribute('data-state') === 'off', 'Menu did not close');
      }
    } catch(e) { report.failures.push(String(e)); }
    check(!report.jsErrors.length, 'Uncaught JavaScript errors');
    Object.assign(report, classifyCookieControlDiagnostics(report.httpErrors, report.console));
    check(!unexpectedDiagnostics(report.console), 'Unexpected console warnings/errors require review');
    check(!unexpectedDiagnostics(report.httpErrors), 'Unexpected HTTP errors require review');
    report.baselineRequests = report.failedRequests.filter(r => (r.url === 'https://widgetlogic.org/v2/js/data.js' && r.error === 'net::ERR_BLOCKED_BY_ORB') || (/^https:\/\/(region1\.)?google-analytics.com\/g\/collect$/.test(r.url) && r.error === 'net::ERR_ABORTED'));
    check(report.failedRequests.length === report.baselineRequests.length, 'Unexpected failed requests');
    reports.push(report);
    await page.close();
  }
} finally { await browser.close(); }
await writeFile(path.join(outputDir,'report.json'),JSON.stringify(reports,null,2)+'\n');
console.log(JSON.stringify(reports,null,2));
if(reports.some(r=>r.failures.length)) process.exitCode=1;
