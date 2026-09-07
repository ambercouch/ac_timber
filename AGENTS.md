# AC Timber agent guide

## Working principle

AC Timber is a reusable WordPress theme, not a standalone PHP application. Preserve WordPress's template hierarchy, hooks, APIs, and admin/content model. Timber 1 is installed through Composer solely to provide Twig views; Composer is the supported installation method, and plugin-installation messages are legacy behaviour. Do not introduce a broader PHP framework, migrate away from Timber 1, or upgrade/replace the architecture incidentally unless explicitly requested. Prefer a small, client-focused change over cleanup of nearby legacy code. Recommendations for modernization belong outside the implementation unless explicitly requested.

Before editing, inspect the PHP entry point, its Twig candidates, included Twig partials, and related SCSS. Reuse existing templates, components, utilities, placeholders, ACF fields, and helpers before adding another implementation. Do not normalize historical spelling, casing, naming, or formatting as collateral work.

## Repository map

- `functions.php` loads Composer and the theme modules. Theme behaviour lives mainly in `lib/functions--*.php`; ACF registrations are in `lib/acf/`, admin customizations in `lib/admin/`, walkers in `lib/walkers/`, and Timber helpers in `lib/wp-timber/`.
- WordPress entry points (`index.php`, `page.php`, `single.php`, `archive.php`, `woocommerce.php`, and `page-templates/*.php`) prepare a Timber context and select views. Keep WordPress-facing routing/context in PHP and presentation in Twig.
- `lib/functions--timber.php` defines the Timber site/context, image sizes, theme/WooCommerce support, menus, widgets, and Twig additions. Shared Twig values usually belong in its context filter; page-specific values belong in the relevant PHP entry point.
- `templates/base.twig` is the page shell. Page/archive/single views extend it; reusable markup is primarily under `templates/inc/` and content variants under `templates/content/`. Respect existing fallback arrays and dynamic filename conventions when adding variants.
- `lib/functions--ac-menus.php` and `lib/functions--ac-sidebars.php` are the menu/sidebar switchboards. `lib/functions--cpt.php` is the opt-in custom-post-type switchboard; its includes are intentionally commented by default and implementations live in `lib/cpt/`.
- ACF can be supplied as a plugin or loaded from the vendored `lib/acfp/` copy by `lib/functions--acf.php`. Treat `lib/acfp/` as third-party code: do not edit it for ordinary theme work.
- Source JavaScript is `assets/js/ac_timber.js`. The Gulp 4 pipeline emits minified JavaScript to ignored `dist/js/`, combines vendor CSS into ignored `assets/scss/_vendor.scss`, builds ignored root `style.css` plus its map, and generates ignored `templates/inc/defs.svg` from `assets/images/svg/`.

## Styling conventions

- `assets/scss/main.scss` is the import manifest. It loads settings before base/object/component/layout/module layers and loads `_client-styles.scss` last. Add a partial to the appropriate layer and its aggregator rather than bypassing this order.
- For client work, put variable overrides in `assets/scss/settings/_settings.client.scss` and selectors in `assets/scss/_client-styles.scss`. Defaults commonly use `!default`, so client variables are deliberately imported first.
- WordPress's `ACT Client Code` ACF option becomes `client-code-{{ options.act_client_code }}` on `<body>`. Nest client selectors under that class (following the scaffold in `_client-styles.scss`) to override default styling through specificity rather than changing reusable defaults.
- Variables configure colours, typography, spacing, widths, breakpoints, and component behaviour. Search existing settings before adding literals or new variables. Runtime ACF design choices also emit CSS through `templates/inc/dynamic-styles*.twig`; check that path before duplicating rules in Sass.
- Reuse existing `@extend` options/placeholders and utilities before writing parallel layout/style rules. This codebase uses its own BEM-like vocabulary: `o-` objects, `c-` components, `l-` layouts, `u-` utilities, `is-`/`has-` states, `__` elements, and `--` modifiers. Preserve the exact local pattern, including modifiers appended independently to elements (for example `c-header__heading--page`); do not impose another BEM interpretation.
- Keep the default layers usable without client overrides. Only change base/default styles when the requested behaviour is intended for every site built from the theme.
- Treat duplicate imports, apparent typos, and redundant Sass declarations as legacy artefacts, not deliberate conventions. Do not clean them up incidentally; if one directly affects the task, flag it and make only the smallest appropriate correction.

## PHP, Twig, and WordPress changes

- Follow the existing procedural WordPress hook/module style and Timber 1 APIs (`Timber::get_context()`, `TimberPost`, `Timber::render()`). Do not introduce framework abstractions or silently migrate to a newer Timber API.
- Preserve the `_act` translation domain, escape output at the appropriate WordPress boundary, and continue using WordPress functions for URLs, queries, capabilities, nonces, enqueues, and sanitization.
- Extend the existing context keys and template composition patterns rather than querying repeatedly in Twig. Existing camelCase and snake_case keys are compatibility surfaces and must not be renamed merely for consistency. Use `snake_case` for new PHP/Timber/Twig context keys unless compatibility with an established component requires its existing convention.
- ACF field definitions are PHP registrations. Keep field names/keys stable unless a data migration is explicitly part of the task; existing saved content and option pages depend on them.
- Optional CPT work should enable or adapt the existing `lib/cpt/` implementation and its matching templates/ACF support where possible. Do not enable unrelated post types.
- Preserve accessibility hooks and state contracts in markup: `site-accessibility.twig`, `aria-*`, `data-control`, `data-container`, `data-state`, and JS-generated `has-*`/`is-*` classes are coupled across Twig, JS, and SCSS.
- Treat `.old` files, commented-out historical implementations, and clearly superseded template patterns as reference/legacy material, not current examples. Do not base new work on or delete them unless the task specifically requires it.

## Build and validation

There is no committed test suite or universal `gulpfile.js`. Gulp 4 is the standard for new client websites: copy `gulpfile.v4.example.js` as the starting point for a project's ignored `gulpfile.js`, then apply project-specific settings such as BrowserSync configuration. Do not introduce Gulp 3 for new work or commit generated/ignored output unless asked. After a change, run the narrowest relevant checks:

- PHP: `find . -path './vendor' -prune -o -path './lib/acfp' -prune -o -name '*.php' -print0 | xargs -0 -n1 php -l`
- SCSS/assets: use the project's local/client Gulp 4 `gulpfile.js` when one is supplied; relevant tasks are `styles`, `scripts`, and `svgdefs`.
- WordPress behaviour: exercise the affected template in a configured WordPress site, including responsive and keyboard behaviour for visible UI changes.
- Before finishing, use `git status --short` and ensure only requested source files are included. Never overwrite unrelated working-tree changes or commit dependencies/generated files (`vendor/`, `node_modules/`, `dist/`, `style.css`, maps, `_vendor.scss`, critical CSS, or generated SVG defs).

When ambiguous legacy behaviour directly affects a task, flag it for the maintainer and make the smallest necessary correction rather than establishing a new convention or performing broad cleanup.
