# Insights review mock-up

Local preview: https://sarahsilva.ddev.site/en/insights-review/
Local page: 32300, title **Insights**, template **Insights (review mock-up)**.
Editor: https://sarahsilva.ddev.site/wp-admin/post.php?post=32300&action=edit

Work is local only. No commit, push, CMT deployment, content migration, plugin installation, menu change or permanent content-model decision was made.

## Verified source and architecture

Before editing, the active theme was confirmed as `ac_timber`, a clean checkout of `git@github.com:ambercouch/ac_timber.git`, branch `master-CMT`, commit `2a70940e40b41146ce6547f45dcaa94cdd3e381e`. A read-only remote lookup confirmed that same branch head. Existing Git metadata was present, so no files were replaced or checkout established.

The project-level `.ambercouch/cloudways-deploy.json` records CMT staging `dev.sarahsilva.de`, Git deployment enabled, that repository/branch and webroot-relative path `wp-content/themes/ac_timber`. Reverify the contract and branch before later deployment. Production is outside this task.

The mock-up follows existing Timber 1 PHP controllers, Twig inheritance, `lib/functions--*.php` includes, programmatic ACF fields, `_act` translations, BEM SCSS, theme units and colour variables. It reuses the existing blog card class, site fonts, header, footer and WPML routing. No additional plugin is needed; bundled ACF Pro supplies the editor controls. Existing custom-loop shortcodes were inspected as part of the theme patterns but are not extended: a page-scoped catalogue avoids introducing post types/taxonomies simply for the review.

## Content and editing

In the English page editor, find **Insights content**. Choose any catalogue item for positions 1, 2 and 3. These positions determine the display order, independently of publication date. All three are required, and duplicate choices are rejected. Saving persists the ACF values; featured keys are removed from the lower list. The remaining dated items sort newest first, followed by undated items. No dates are invented for samples or the PDF.

Initial featured choices:

1. `ai-costs`: Four reasons AI translation costs more than you think — existing article, English synopsis and WPML-resolved destination.
2. `translation-brief`: Your translation brief — existing English PDF.
3. `case-product`: Taking a specialist product to an English-speaking market — sample, no link.

Other catalogue items:

| Key | Content | Status |
| --- | --- | --- |
| `qualifications` | What specialist translation qualifications mean | Existing article; English synopsis |
| `food-markets` | Opening new markets for food businesses | Existing article; English synopsis |
| `case-research` | Making complex research clear | Sample; no link |
| `research-language` | How language shapes trust in scientific communication | Sample research topic; no findings asserted; no link |
| `download-checklist` | Scientific publication checklist | Sample download; no file or link |

All new headings, summaries, categorisation, sample topics and the page name are provisional editorial choices. Source articles and the translation-brief PDF already existed. The catalogue is deliberately limited to eight entries; changing its membership/copy currently means editing `lib/functions--insights.php`. Featured selection/order, title eyebrow and introduction are editor features. This is not an automatic feed or content migration.

WPML: German remains the default. The new page is a standalone English original with no German counterpart, served by existing `/en/` routing. No language, navigation or translation settings were changed. Article sources resolve by existing German slugs, then `wpml_object_id` selects the current language version with original-language fallback. Dates, images and language labels come from the resolved post. The tested links all resolve to existing English articles. Interface strings use `_act`; editorial catalogue copy remains provisional English. The theme's existing ACF options-language filter remains unchanged.

## Files needed for CMT reproduction

Changed existing files:

- `functions.php`: loads the page-scoped feature module.
- `assets/js/ac_timber.js`: progressively enhanced native-button filters.
- `assets/scss/main.scss`: imports the page stylesheet.
- `templates/base.twig`: adds an overridable document-title block, retaining the previous title for other templates.

New files:

- `lib/functions--insights.php`: catalogue, ACF fields and duplicate validation.
- `page-templates/insights.php`: controller and dated sorting/featured exclusion.
- `templates/page-insights.twig`: page layout.
- `templates/inc/insights-card.twig`: featured card.
- `templates/inc/insights-list-card.twig`: main-list card using the current blog card structure and classes.
- `assets/scss/modules/_insights.scss`: responsive styles scoped to this page.
- `docs/setup-insights.php`: optional WP-CLI page setup helper.
- `docs/insights-mockup.md`: this handoff.

Generated runtime files: `style.css`, `style.css.map`, `dist/js/main.js`. These are ignored by the existing repository and do not appear in the normal Git diff. A later Git-only source deployment will therefore **not** deliver the new CSS/JS by itself. Verify the existing CMT build/artifact delivery mechanism and include the rebuilt assets through that mechanism. Do not assume Cloudways runs Gulp. No ignore rules or dependencies were changed here.

The setup helper and this handoff live inside the theme repository; project-level `docs/insights-validation/` contains local screenshots, report and browser script and is outside that repository.

## Build and local validation

PHP is 8.3 in DDEV. Use the existing installed dependencies, NVM and Node 10.24.1 for the legacy Gulp build; do not upgrade them.

```bash
cd /home/rikk_/Sites/sarahsilva/web/wp-content/themes/ac_timber
source ~/.nvm/nvm.sh
nvm use 10.24.1
./node_modules/.bin/gulp styles scripts
```

The build succeeds. Autoprefixer emits its legacy IE grid-support warning; no IE-specific support was added.

From the project root, syntax checks:

```bash
ddev exec php -l web/wp-content/themes/ac_timber/lib/functions--insights.php
ddev exec php -l web/wp-content/themes/ac_timber/page-templates/insights.php
```

The local setup can be reproduced on a fresh local database with:

```bash
ddev wp eval-file /var/www/html/web/wp-content/themes/ac_timber/docs/setup-insights.php
```

The helper creates a published English page, assigns the template and saves featured values through ACF. If that slug already exists it stops without changing the page. Do not run it against a remote site as part of local validation.

Browser validation uses Node 24:

```bash
source ~/.nvm/nvm.sh
nvm use 24
node ~/Tools/ac-timber-browser/inspect.mjs https://sarahsilva.ddev.site/en/insights-review/
node docs/insights-validation/validate.mjs
```

The custom script imports the existing shared Playwright installation and saves its report/screenshots beside itself. Tested at 1440, 390 and 320 pixels: all five filters by mouse and Tab/Enter/Space, pressed states, result counts, three featured cards, exclusion, date ordering, sample cards without links, no horizontal overflow, and no-JavaScript fallback. Four card destinations returned 200, including the English PDF with `application/pdf`. No browser console warnings/errors, uncaught JS errors, failed requests or HTTP errors were recorded. Desktop and mobile screenshots were visually inspected.

Local `docs/insights-validation/check-featured.php` additionally changed saved ACF selections, fetched the rendered page to verify order and exclusion, then restored the original values in a `finally` block. This is a local-only database test, not a staging setup step.

The existing 320px mobile masthead has very tight spacing between logo and menu; masthead styling was not changed. WordPress's existing Cloudflare plugin logs an outbound API attempt during page publication; local HTTP blocking prevented it. No Cloudflare configuration was changed.

## Later CMT setup and acceptance

Only after deployment is separately authorised:

1. Reverify the Cloudways contract, repository, branch and deployment path. Deliver the source files above plus rebuilt runtime CSS/JS. Retain existing dependencies and site settings.
2. Confirm bundled ACF Pro, Timber vendor files, WPML and existing theme options are present. Keep German default and English enabled with directory routing.
3. In WordPress's English page list, create **Insights**, slug `insights-review`, select **Insights (review mock-up)**. Leave body empty and do not add the page to menus. Save the three featured choices listed above, then publish. Alternatively, review and run the included setup helper through staging WP-CLI from the correct WordPress root; it must receive separate deployment authorisation first.
4. Confirm the three source slugs in `act_insights_catalogue()` exist and their English WPML counterparts are correctly linked. Confirm uploads contain `2026/04/Translation-brief.pdf`; the file resolver uses the environment's uploads directory/URL. Missing files have no link. Copy only that existing PDF if staging lacks it; no sample files are required. Do not import the local database or assume local page ID 32300 on staging.
5. Confirm the expected preview route `https://dev.sarahsilva.de/en/insights-review/` after setup. This is an expected future URL, not a deployed preview.
6. Clear relevant staging caches if needed. Repeat desktop/mobile, all filter and keyboard checks, editor selection/order/duplicate validation, dated ordering, featured exclusion, every card link and browser/network checks. Check existing navigation, blog, newsletter and resources remain intact and no DDEV URLs leak into staging output.
7. Ask Sarah to review the name, topic mix, featured treatment and proposed content before deciding content migration, post types, taxonomies or permanent categories.

## Review styling update

The main list now uses the existing blog list width and blog card image/header/body/footer classes. Filters use the blog category-menu classes with native buttons and synchronised current-menu-item state. Review instructions and implementation notes have been removed from the preview; sample summaries are example editorial copy, with short Sample labels and no invented destinations. Result announcements remain available to screen readers. Rebuilt styles/scripts and repeated desktop/mobile, mouse/keyboard and link checks.

## Editable page introduction

Edit the English Insights page and open **Insights content**. **Title eyebrow** is a plain-text field; **Introduction** is a multiline plain-text field with line breaks preserved. Clear either field to hide it. The main heading continues to use the standard WordPress page title. Both fields use ACFML translate preferences, so future translations can have their own copy. Existing preview copy is saved in page metadata, rather than hardcoded in Twig. New-page setup seeds the same values. When updating an already-created CMT preview, populate these two fields manually; the setup helper deliberately does not overwrite existing pages.
