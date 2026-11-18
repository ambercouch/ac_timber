# Business Translated development deployment

Status: prepared for feature-branch review. **Deployment remains blocked pending verified Cloudflare zone ID and zone-scoped Cache Purge access.** No deployment, upload, remote deletion/quarantine or cache purge has been performed. Target is **Staging-BTL**, https://dev.businesstranslated.com. No production target is supported. Findings and local validation: 18 November 2026.

## Source and asset payload

Repository: `ambercouch/ac_timber`, current local/staging base `master-BTL` at `5f89594a4cdf11a9807088fe5f656091d8841114`. The final release SHA awaits approved review/commit/push/build.

Application source changes:

- `assets/scss/components/_components.burger.scss`: closed toggle bars use deep teal (`$col-dark`) instead of cream; open-state bars remain cream.
- `functions.php`: frontend `wp_enqueue_scripts` callback enqueues handle `ac-style` with `hash_file('sha256', style.css)` as the WordPress version. URL is `style.css?ver=FULL_CONTENT_HASH`, not a timestamp or Git SHA. Hash is calculated from the actual compiled file on each request; missing/unreadable file uses no version rather than a fabricated content version.
- `templates/inc/footer_scripts.twig`: removes the old duplicate hardcoded `style.css?v=2023` link. The main sheet now uses WordPress's normal head enqueue output. All other theme/plugin stylesheet registrations and links, including admin/login CSS and Typekit, are unchanged. Local visual checks found no layout regression.
- `tools/deploy/`: reviewed deployment workflow, configuration example, validation, operator-assisted hooks and local guard tests.

Generated upload allowlist: **`style.css`, `style.css.map` only**. Do not upload vendor SCSS, JS, SVG, dependencies or a whole release/build directory. No database/menu/settings transfer is needed. Never deploy `wp-config.php`, `.ddev`, `node_modules`, local WAF/cache disablement or local safety constants.

## Verified staging and credentials

| Item | Verified value |
| --- | --- |
| WordPress home/active stylesheet | `https://dev.businesstranslated.com`, `ac_timber` |
| SSH host/user | Verified through existing private SSH configuration; no host/user/key material recorded here |
| SSH application root | `VERIFIED_SSH_APPLICATION_ROOT` |
| SSH WP root | Application root + `/public_html` |
| SSH active theme | Application root + `/public_html/wp-content/themes/ac_timber` |
| SSH Cloudways Git checkout | Application root + `/git_repo`, metadata `/.git` |
| Origin/checkout branch/HEAD | `git@github.com:ambercouch/ac_timber.git`, `master-BTL`, `5f89594a4cdf11a9807088fe5f656091d8841114`; clean |
| SFTP chroot | `/` maps to SSH application root |
| SFTP active theme | `/public_html/wp-content/themes/ac_timber` |
| Private backup parent | SSH application root + `/private_html`; SFTP `/private_html`; exists and SSH-writable |
| Proposed backup root | SSH private parent + `/btl-releases`; SFTP `/private_html/btl-releases`; not created during preparation |
| PHP | CLI 8.3.36 |

SSH host verification and SFTP read access succeeded; downloaded CSS hash matched SSH. Upload/rename permissions remain deliberately untested. Remote Git reads require a command-scoped `safe.directory` exception; the script now supplies it with `GIT_OPTIONAL_LOCKS=0`, without editing global Git config.

Keep real configuration outside Git: copy `config.example.json` to `~/.config/btl-deploy/development.json`, mode 600, parent mode 700. Use an SSH alias in private `~/.ssh/config`, key/agent authentication, BatchMode and fingerprint-verified known_hosts. Config requires **separate SSH and SFTP paths for both theme and backup root**. The script validates their mapping to `ssh_app_root`, canonical remote roots and staging URL/theme identity. The example contains no credentials.

HTTP Basic Auth is now verified. Private file: `~/.config/ambercouch/btl-staging-http.json`, username/password fields, mode 600. A private wrapper should read it into `BTL_HTTP_USERNAME` / `BTL_HTTP_PASSWORD` environment variables in memory for `validate.sh`; never echo/source JSON, use command-line credential literals, enable shell tracing, or commit credentials. `BTL_ACTION_LOG` must point to a private absolute local log path; operator hooks record deployment/purge evidence only.

## Standalone ACF and source equivalence

Standalone **ACF Pro 6.5.0 is active and supplies runtime PHP**. Full runtime reflection located `acf_get_setting()` at `wp-content/plugins/advanced-custom-fields-pro/includes/api/api-helpers.php`; configured PHP root and asset URL path resolve to that standalone plugin. The merged prerequisite `dc0797b1fcc39fd99537d38384f3ae0a854673ea` is already deployed. Keep the plugin active and retain theme `lib/acf/` fields/options; Timber remains 1.x.

All 318 tracked base paths were compared with the active served theme: 315 match byte-for-byte; only `.gitignore`, `assets/.gitignore`, `templates/.gitignore` are absent. The corrected script permits **only absence** of those three exact metadata paths; if present, they must match their hashes. Missing/changed PHP, Twig, SCSS or other source fails verification.

Staging inventory: 685 files, zero symlinks. Exactly 370 files are outside Git: five generated files below and 365 obsolete files in `lib/acfp/`. No additional staging-only custom source/config/assets were found inside this theme. Full private inventory: `/tmp/btl-staging-inventory-20261118.json`; retain it with the eventual durable backup. Files outside this theme are outside deployment scope.

| Generated file | Staging SHA-256 | Treatment |
| --- | --- | --- |
| `style.css` | `eccbcf9a61cd2bb31e3d64365dcfde858fa1215095f2b28d584959602b554b97` | Back up, replace from release |
| `style.css.map` | `16629d8621bcdb7b68e03bf6b591ec6c9fcf928f340e67cc2fdf205252289822` | Back up, replace from release |
| `assets/scss/_vendor.scss` | `39971ad338e5a1e08066b209e4a51d8429f5739ecbcfc55c78e929c90b2bf0ea` | Preserve, matches local |
| `dist/js/main.js` | `71aede89a552fd5d0d521b694475a77d942eea55860f7293917457aaf086f712` | Preserve, matches local |
| `templates/inc/defs.svg` | `861ce57b1b318b17ea6174b7c7b3ae4ed873de474efda16780596ea65aa4fa16` | Preserve, matches local |

All five had mode 0664. The corrected script records hashes/modes and verifies all five before and after Cloudways source deployment. Only CSS/map may change during SFTP upload; vendor/JS/SVG must remain exact. Uploads use unused temporary filenames, reject existing paths/symlinks, verify hashes, preserve prior modes and then rename. Replacement is sequential, not an atomic whole-site release.

## Build and execution sequence — only after deployment authorization

Requires Python 3.12+, Git/OpenSSH/SFTP, NVM Node **10.24.1** / npm **6.14.12** for build, and Node **24** with existing Playwright for validation. No dependency/runtime upgrades.

1. Review the three application-source changes and workflow tooling; review/commit/push through the agreed branch/PR policy. Do not stage generated files or credentials. If merged, use the final merge SHA and a clean checkout. Confirm source is on origin. This script never commits or pushes.
2. Build that exact committed SHA:

   ```bash
   python3 tools/deploy/deploy.py build \
     --config "$HOME/.config/btl-deploy/development.json" \
     --release "$HOME/btl-releases/RELEASE_ID" --sha FULL_REVIEWED_SHA
   ```

   The script exports only committed source into an isolated release directory, loads NVM, asserts Node/npm versions, runs `npm ci`, `gulp vendorStyles`, then `gulp styles`. `vendorStyles` is necessary because `_vendor.scss` is absent from the Git export. It is an intermediate, never uploaded. Build errors are checked in logs as well as status, since legacy Sass can swallow errors. Three known IE grid warnings remain. It preserves current local CSS/map and records source SHA, all tracked source checksums and CSS/map SHA-256 in `manifest.json`. Inspect logs/output before continuing.
3. After policy approval, push immutable `deploy/btl-FULL_SHA` refs at both release and previous staging SHAs; confirm origin values with `git ls-remote`. Never move these refs. Configure the Cloudways Git hook for these exact branches, including rollback.
4. Run `backup`: verify staging/ACF identity and served source; snapshot all five generated files/modes; archive the entire active theme except `.git` and `node_modules` outside the webroot. Download via the SFTP chroot path and verify archive hashes locally/remotely. Recheck source/asset stability before recording `remote-before.json`. No existing backup is overwritten.
5. If obsolete ACF still exists, run the **separate explicitly authorized** `cleanup-acf` phase after backup and before `deploy-source`. It verifies local/remote backup checksums, active standalone plugin status, resolved ACF PHP provider, expected revision, and that neither release nor rollback source tracks `lib/acfp/`. It rejects symlinked/redirected theme, `lib`, target and backup paths, compares the current subtree against its archived copy, and checks all generated files. It then **moves exactly `THEME/lib/acfp` to `RELEASE_BACKUP/obsolete-acfp`** and rechecks runtime prerequisites. There is no recursive deletion command or generic cleanup path. No parent directory, standalone plugin or other staging-only asset is touched. This phase has not been run.
6. Run `deploy-source`: operator-assisted `cloudways-git-manual.sh` performs the reviewed Cloudways UI deployment and records its ID; the script independently verifies remote Git SHA, served source hashes, absence of obsolete ACF and preserved generated files. An authenticated API hook may replace the manual hook later. No remote `git reset`, `git pull`, source SFTP upload or broad clean is used.
7. Run `upload`: verify source/asset state again, upload only CSS/map through SFTP and verify hashes/modes before renaming. No `node_modules`, database, WordPress config or local safety files can enter through this allowlist.
8. Run `finish`: verify source/CSS and preserved files, invoke the reviewed narrow purge hook below, then `validate.sh`/`validate.mjs` at all viewport sizes. Check the normal stylesheet URL contains `ver=CSS_SHA256` and returned CSS hashes to it. Inspect screenshots and classify pre-existing third-party failures. Keep source, assets and caches coordinated during the deployment window.

For phases 4–8:

```bash
python3 tools/deploy/deploy.py PHASE \
  --config "$HOME/.config/btl-deploy/development.json" \
  --release "$HOME/btl-releases/RELEASE_ID"
```

Configured hook executables use argv arrays, not shell evaluation. `cloudways-git-manual.sh` and `purge-manual.sh` record operator evidence; they do not prove Cloudways policy/API permissions. `validate.sh` loads Node 24 and compares the CSS manifest. Baseline rollback uses `--baseline`, allowing the previous cream bars rather than pretending the old source contains the fix. The validator now checks content-derived CSS URL versions for release validation.

## Narrow cache-purge operations

Verified: Breeze 2.2.24 active, page/mobile/browser caching enabled, standalone (non-multisite), Varnish **active**, Breeze target **127.0.0.1** and auto-purge enabled. Breeze CDN integration disabled. Hummingbird page cache/minification/Redis/Cloudflare integration disabled. Redis object-cache drop-in active despite inactive Object Cache Pro plugin. Cloudflare serves current stylesheet as `HIT` with `public, max-age=31536000`; homepage and map were `DYNAMIC`. Evidence: `/tmp/btl-staging-cache-headers-20261118.json`.

Prepared operations for the later authorized purge hook, **none executed**:

1. Breeze local minification/HTML cache:

   ```bash
   wp --path=VERIFIED_WP_ROOT breeze purge --cache=local
   ```

   Installed implementation clears minification and local HTML; the inspected CLI/no-current-post context does not globally flush Redis.
2. Staging-host Varnish, using its installed handler and checking actual response:

   ```bash
   wp --path=VERIFIED_WP_ROOT eval '$r=(new Breeze_PurgeVarnish())->purge_cache(home_url("/?breeze")); if (is_wp_error($r) || wp_remote_retrieve_response_code($r)!==200) { WP_CLI::error("Staging Varnish purge failed"); } WP_CLI::success("Staging Varnish purge returned 200");'
   ```

   Handler targets localhost with Host `dev.businesstranslated.com`; run target identity checks first. Do not trust the stock CLI's unconditional Varnish success text alone.
3. Cloudflare exact-URL purge for staging HTML validation pages, old `style.css?v=2023`, bare CSS/map, and new `style.css?ver=MANIFEST_CSS_HASH`. Use `POST /client/v4/zones/VERIFIED_ZONE_ID/purge_cache` with `files`; **never `purge_everything`**. Include any verified cache-key variants/query strings. [Official purge API](https://developers.cloudflare.com/api/resources/cache/methods/purge/) and [cache-key requirements](https://developers.cloudflare.com/cache/how-to/purge-cache/purge-cache-key/).
4. Re-request public URLs and verify content hashes, HTML version references and cache response headers, then menu/screenshots. Server purges cannot erase existing browser caches; content versioning supplies a new URL. PHP hashing is outside Twig's rendered-template text, but stale compiled templates/page caches can retain the removed footer link: verify one main stylesheet, not both URLs, after deployment.

Do not use Breeze's broad `--cache=all`/admin all-cache action: installed callback also invokes Cloudflare and `wp_cache_flush()`. Do not globally flush Redis. Hummingbird does not require a purge while its cache/minification features remain disabled. For the new PHP enqueue/Twig edit, confirm PHP-FPM revalidation and Timber/Twig cache behaviour; use only an application-scoped supported refresh if verification shows stale source. CLI PHP settings do not prove PHP-FPM state.

## Rollback

Run `rollback` with the same private config and release directory. It verifies the backup, deploys the captured prior SHA through Cloudways Git, verifies served source, then restores **all five exact generated baseline files** from the archive, including prior modes. It verifies restored CSS hashes and preserved asset hashes/modes, purges the same narrow staging cache scope and reruns baseline browser validation. Keep standalone ACF active; no DB/plugin/settings rollback occurs.

The obsolete ACF quarantine remains privately backed up; normal rollback does not reintroduce an unused library because the verified prior revision already uses standalone ACF. If separately required for exact forensic restoration, the archive/quarantine is retained for supervised restoration of only that subtree after checking runtime conflicts. If cleanup's post-check fails, the local `acf-quarantined` marker is already written and identifies its private backup; stop rather than continuing to deploy.

If Cloudways deletes generated files, script preservation checks stop deployment. Rollback restores those assets from backup; do not improvise a rebuild of unverified JS/SVG tasks. If source rollback itself fails, use the downloaded theme archive for supervised file recovery, never over WordPress root and never a DB restore. Retain immutable refs/backups until sign-off.

## Local verification completed

- Node 10.24.1 `gulp styles` passed with the three known IE grid warnings; CSS/map preserved before build.
- PHP 8.3 syntax check passed for `functions.php`.
- Playwright Node 24 passed at 390, 840, 999, 1000 and 1440px: HTTP 200, exactly one main stylesheet, URL `ver` equals served CSS SHA-256, no overflow/console/JS/HTTP errors; teal bars and six-item menu opening/closing below 1000px; hidden toggle on desktop. Mobile/tablet/desktop and open-menu screenshots visually inspected.
- Temporarily appended a valid CSS comment: a new request produced a different matching version. Exact original CSS bytes restored in a finally block; CSS/map/vendor/JS/SVG preservation verified. Output: `/tmp/btl-local-content-version/`.
- Seven local deployment guard tests passed, including scoped Git handling, only-known-missing metadata, changed generated files, and runtime/backup/symlink cleanup failures before any move. Run `python3 tools/deploy/test_deploy.py`; tests execute local fixtures/mocked SSH only.
- Known Widget Logic ORB and Analytics aborts remain separate from local regressions.

Staging baseline: Basic Auth works and previous menu interactions passed; cream toggle remains because the fix is undeployed. **Cookie Control's HTTP 400/settings-verification console error is pre-existing**, observed before any deployment. Keep it recorded; no Cookie Control settings were changed. The staging validator keeps the exact verified HTTP 400 and its corroborated, exact-source console errors visible as labelled known-baseline entries; they alone do not fail validation. All other HTTP errors and console warnings/errors still fail. WordPress-admin ACF editing/options validation requires an authorized admin session.

## Exact decisions/permissions still required

1. **Cloudways deployment policy (approved by the user):** manual, explicitly triggered Git deployment of immutable `deploy/btl-FULL_SHA` refs (including rollback), rather than automatic deployment of moving `master-BTL` on push. Confirm Staging-BTL's repository/destination maps only to the active theme and its source-copy policy **preserves ignored/untracked generated assets**; no broad `--delete`/`git clean`. Permit omission of exactly the three metadata files. Obsolete ACF removal is exclusively the separate backed-up `cleanup-acf` phase. Pushing to GitHub must never trigger deployment. Cloudways UI/API configuration must match this approved policy; a checkout branch alone cannot establish it. An auto-deploy on the first source push would violate the required push → local build → explicit deployment sequence.
2. **Cloudflare permission:** supply a private token (or an authorized dashboard operator) with **Cache Purge** permission restricted to the `businesstranslated.com` zone, plus a verified zone ID. The hook must restrict requested URLs to `https://dev.businesstranslated.com/`; the zone permission can also affect production, so that hostname restriction is enforced by operational scope, not implied by zone scoping. Read-only Zone/Cache Rules/Page Rules access or dashboard confirmation is additionally needed to establish custom cache-key/query-string handling. No zone-wide purge is authorized. [Cloudflare permission/API reference](https://developers.cloudflare.com/api/resources/cache/methods/purge/).

Private hooks/configuration still need to be completed against these decisions, and upload/purge/rollback success must be verified only in an authorized deployment window. Final release SHA/checksums await the approved PR review and subsequent build. Nothing in the completed local work authorizes deployment or remote cleanup.

## Enforced deployment block and public-review hygiene

All remote-writing phases, including backup, cleanup, source deployment, upload, finish and rollback, now require `cloudflare_verification_file` in the private config. Its default is null, so these phases fail before opening SSH or invoking hooks. Build remains local-only and available. The private mode-600 verification record must contain `zone_id` (verified 32-character hexadecimal ID), `zone_name` (`businesstranslated.com`), `cache_purge_access_verified: true`, `verification_evidence` (reviewed API/dashboard evidence reference, no token), and `allowed_origin` (`https://dev.businesstranslated.com`). This record is an operator attestation of actual verification, not a token-validity probe or a substitute for checking token permissions. Do not create it until zone-scoped Cache Purge access is verified. Keep it outside Git and logs. Purge-hook implementation must enforce the exact staging origin on every URL and reject zone-wide purge bodies. The current operator-assisted purge hook is not an automated API client.

The feature branch contains only application source and generic deployment tooling/docs/examples. Actual host/user/application-root values, credentials, local configuration and generated assets are excluded. The user's manual-deployment policy is settled: record the exact commit, preserve ignored assets and never trigger deployment from GitHub pushes. No auto-deploy workflow is added by this PR; live control-plane policy must remain consistent with that instruction.

### Precise Cookie Control diagnostic classification

`validation-baseline.mjs` matches the verified staging XHR settings-verification request by status 400, exact endpoint and SHA-256 of its complete canonical URL, including every query value. Query values/API keys are not stored in source/reports. A changed key, domain, product, version, extra parameter, endpoint, resource type or status is unexpected and fails. Console classification requires that matching HTTP response in the same viewport report: only the exact resource-400 message at that request location, or the exact settings-verification message from the verified Civic v9 script/location, is baseline. The original records remain in `httpErrors`/`console` with `classification` and `baselineIssue`; nothing is discarded. Other diagnostics, including matching text from another location, continue to fail. The `--baseline` switch only controls pre-release CSS expectations, not broader HTTP/console exemptions.

Regression command: load NVM, select Node 24 and run `node --test tools/deploy/test-validation-baseline.mjs`. Cases cover exact matches, missing corroboration, altered status/request/source/text and known-plus-unrelated errors. No deployment or purge is involved.
