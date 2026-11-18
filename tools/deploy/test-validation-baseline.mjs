import test from 'node:test';
import assert from 'node:assert/strict';
import { COOKIE_CONTROL_REQUEST, SETTINGS_ERROR, RESOURCE_ERROR, requestFingerprint,
  classifyCookieControlDiagnostics, unexpectedDiagnostics } from './validation-baseline.mjs';

const http = {status:400, url:'https://apikeys.civiccomputing.com/c/v',
  requestFingerprint:COOKIE_CONTROL_REQUEST, resourceType:'xhr'};
const resource = {type:'error', text:RESOURCE_ERROR, url:http.url,
  requestFingerprint:COOKIE_CONTROL_REQUEST, line:0, column:0};
const settings = {type:'error', text:SETTINGS_ERROR,
  url:'https://cc.cdn.civiccomputing.com/9/cookieControl-9.x.min.js',
  requestFingerprint:'3f797380b2f1d5bfb500ff2b38b12f9919f253e5fc472877f96cee56d1df0fb0', line:0, column:71200};

const classify = (errors=[http], messages=[resource,settings]) => classifyCookieControlDiagnostics(errors,messages);

test('exact verified response and corroborated console errors remain visible as baseline', () => {
  const result=classify();
  assert.equal(result.httpErrors.length,1); assert.equal(result.console.length,2);
  assert.equal(result.httpErrors[0].status,400);
  assert.equal(result.console[1].text,SETTINGS_ERROR);
  assert.equal(result.httpErrors[0].baselineIssue,'cookie-control-settings-verification');
  assert.equal(unexpectedDiagnostics(result.httpErrors),false);
  assert.equal(unexpectedDiagnostics(result.console),false);
});

test('other statuses, requests, query values, origins, paths and resource types still fail', () => {
  for(const change of [{status:401},{status:404},{status:500},
    {url:'https://dev.businesstranslated.com/c/v'}, {url:http.url+'-other'},
    {requestFingerprint:'changed-query'}, {resourceType:'document'}]) {
    const result=classify([{...http,...change}]);
    assert.equal(unexpectedDiagnostics(result.httpErrors),true,JSON.stringify(change));
    assert.equal(unexpectedDiagnostics(result.console),true);
  }
});

test('a known baseline cannot conceal another HTTP error', () => {
  const result=classify([http,{...http,url:'https://dev.businesstranslated.com/missing.css',status:404}]);
  assert.equal(result.httpErrors[0].classification,'known-baseline');
  assert.equal(unexpectedDiagnostics(result.httpErrors),true);
});

test('console suppression requires the matching baseline response', () => {
  assert.equal(unexpectedDiagnostics(classify([], [resource,settings]).console),true);
});

test('same console text from other sources or locations, and altered messages, still fail', () => {
  for(const original of [resource,settings]) {
    for(const change of [{type:'warning'},{url:'https://dev.businesstranslated.com/app.js'},
      {requestFingerprint:'other-source'}, {line:1}, {column:original.column+1},
      {text:original.text+' changed'}]) {
      assert.equal(unexpectedDiagnostics(classify([http],[{...original,...change}]).console),true);
    }
  }
  assert.equal(unexpectedDiagnostics(classify([http],[settings,{...settings,text:'Unrelated console error'}]).console),true);
});

test('request fingerprint hides query values and matches only identical canonical requests', () => {
  const a=requestFingerprint('https://example.com/c/v?d=dev.example.com&k=private');
  assert.match(a,/^[a-f0-9]{64}$/);
  assert.equal(a,requestFingerprint('https://example.com/c/v?k=private&d=dev.example.com'));
  assert.notEqual(a,requestFingerprint('https://example.com/c/v?d=prod.example.com&k=private'));
  assert.notEqual(a,requestFingerprint('https://example.com/c/v?d=dev.example.com&k=different'));
  assert.notEqual(a,requestFingerprint('https://example.com/c/v?d=dev.example.com&k=private&extra=1'));
});
