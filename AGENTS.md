# Business Translated theme workflow

## Project

- This repository is the standalone Business Translated AC Timber theme, not the WordPress installation.
- WordPress project: businesstranslated
- Local DDEV URL: https://businesstranslated.ddev.site
- DDEV root: /home/rikk_/Sites/businesstranslated
- WordPress docroot: /home/rikk_/Sites/businesstranslated/web
- PHP: 8.3

## Working principles

- Preserve the existing architecture and coding conventions unless explicitly asked to change them.
- Inspect existing implementation before editing.
- Prefer the smallest reliable change.
- Avoid unrelated cleanup.
- Do not update WordPress, plugins, themes, Node, npm, Composer dependencies or build tooling unless explicitly required.
- Never expose credentials, API keys or secrets.

## Theme source and build workflow

- Active standalone theme: `web/wp-content/themes/ac_timber`; repository: `https://github.com/ambercouch/ac_timber.git`, base branch `master-BTL`.
- The theme requires Timber 1.x PHP/Twig and the standalone Advanced Custom Fields PRO plugin (validated with ACF Pro 6.5.0). Keep ACF Pro installed and active locally, on staging and in production.
- Field definitions and options pages remain in `lib/acf/`. Do not embed another ACF copy or override its filesystem/asset paths; ACF PHP and assets must resolve to `wp-content/plugins/advanced-custom-fields-pro/`. The embedded `lib/acfp/` library has been removed.
- Edit theme PHP controllers, `page-templates/`, `templates/`, `lib/`, `assets/scss/`, `assets/js/ac_timber.js` and source images for the relevant change. `assets/css/ac-admin.css` is used directly.
- Use the tracked `gulpfile.js`, not historical/example Gulp files. Load NVM before Node commands.
- Legacy build runtime: Node **10.24.1**, npm **6.14.12**. The theme `.nvmrc` selects Node 10.24.1. DDEV Node 24 is not the theme build runtime.
- Install with `npm ci`; do not regenerate lockfiles or upgrade legacy dependencies incidentally. `gulp-rename` belongs only in devDependencies.

Run from the theme directory:

```bash
cd /home/rikk_/Sites/businesstranslated/web/wp-content/themes/ac_timber
source "$HOME/.nvm/nvm.sh"
nvm use
node --version
npm --version
npm ci
./node_modules/.bin/gulp styles
```

Run only tasks relevant to the change:

| Source | Task | Output |
| --- | --- | --- |
| `assets/scss/main.scss` and imported partials | `./node_modules/.bin/gulp styles` | `style.css`, `style.css.map` |
| Vendor JS (FitVids, Remodal, Flickity) and `assets/js/ac_timber.js` | `./node_modules/.bin/gulp scripts` | `dist/js/main.js` |
| Remodal vendor CSS | `./node_modules/.bin/gulp vendorStyles`, then `styles` | `assets/scss/_vendor.scss`, then compiled CSS/map |
| `assets/images/svg/*.svg` | `./node_modules/.bin/gulp svgdefs` | `templates/inc/defs.svg` |

- Keep `node_modules/`, `dist/`, `style.css`, `style.css.map`, `assets/scss/_vendor.scss` and `templates/inc/defs.svg` ignored. Rebuild generated files; do not edit or force-add them.
- Validation status: `npm ci` and `gulp styles` passed under Node 10.24.1 / npm 6.14.12. The three legacy IE grid Autoprefixer warnings remain.
- Other tasks (`scripts`, `vendorStyles`, `svgdefs`, `serve` and the default task) are unverified. The mappings above describe the Gulp configuration, not successful execution of those tasks.
- `gulp serve` is configured to watch files and proxy the DDEV URL with automatic browser launch disabled. Bare `gulp` is configured to run all build tasks and start the watcher; prefer explicit tasks for verification.
- Preserve generated CSS/map before build or tooling changes. Inspect logs and generated output as well as exit status: the Sass error handler can log errors without failing the process. Three known legacy IE grid Autoprefixer warnings remain.
- For PHP changes run appropriate PHP 8.3 syntax checks. Review the final diff and Git status; do not commit or push unless instructed.

## Local validation

- Keep `WP_ENVIRONMENT_TYPE=local`, `DISABLE_WP_CRON=true` and `WP_HTTP_BLOCK_EXTERNAL=true`; preserve local cache/WAF disablement.
- After frontend changes, validate the affected pages in Playwright using Node 24, separately from the legacy build shell.

```bash
source "$HOME/.nvm/nvm.sh"
nvm use 24
node ~/Tools/ac-timber-browser/inspect.mjs https://businesstranslated.ddev.site
```

- The shared validator defaults to desktop 1440x1000. Also inspect mobile at 390x844 using an equivalent Playwright run. Check navigation and affected interactions; scroll to load lazy images before assessing them.
- Check document status, console warnings/errors, uncaught JavaScript errors, failed requests and HTTP errors. Check horizontal overflow and visually inspect desktop/mobile screenshots.
- The validator writes `~/Tools/ac-timber-browser/output/homepage-desktop.png`; use separate output paths when preserving comparisons.
- Known baseline: Widget Logic's external script may be blocked by ORB and Analytics requests may abort. Report these separately from regressions. WordPress's external HTTP block does not block browser requests.
- Desktop (1440px) and mobile (390px) homepage checks passed after the prior styles rebuild: HTTP 200, no horizontal overflow, no console errors, uncaught JavaScript exceptions or HTTP errors. Screenshots were inspected and mobile lazy images checked after scrolling. This is a recorded baseline, not a substitute for validation after future changes.
- Staging: `https://dev.businesstranslated.com`, Cloudways application `Staging-BTL`. Validate after an authorized deployment, including cache/CDN behaviour and affected templates/integrations. A local homepage check alone does not establish staging parity.

## Remote environments

- Treat production as protected.
- Prefer local development first.
- Where staging/development exists, deploy there and validate before production.
- Do not make production changes without explicit approval.
