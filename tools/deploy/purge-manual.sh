#!/usr/bin/env bash
set -euo pipefail
[[ ${1:-} = https://dev.businesstranslated.com ]] || exit 2
: "${BTL_ACTION_LOG:?Set an absolute private local action-log path}"
[[ "$BTL_ACTION_LOG" = /* ]] || exit 2
umask 077
printf 'Purge only Staging-BTL Breeze local cache and staging-host Varnish.\n'
printf 'Cloudflare: exact https://dev.businesstranslated.com/ URLs only; never purge_everything or production URLs.\n'
printf 'Use verified zone-scoped Cache Purge access; wait for completion.\n'
printf 'Enter evidence/reference and cache layers purged (empty cancels): '
read -r evidence
[[ -n "$evidence" ]] || exit 1
printf '%s Staging cache purge: %s\n' "$(date -u +%FT%TZ)" "$evidence" >> "$BTL_ACTION_LOG"
