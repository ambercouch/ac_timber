#!/usr/bin/env bash
# Operator-assisted Cloudways Git hook; never performs a remote git reset/pull.
set -euo pipefail
sha=${1:?Expected full source SHA}
[[ "$sha" =~ ^[0-9a-f]{40}$ ]] || exit 2
: "${BTL_ACTION_LOG:?Set an absolute private local action-log path}"
[[ "$BTL_ACTION_LOG" = /* ]] || exit 2
umask 077
printf 'In Cloudways Staging-BTL Deployment Via Git, deploy immutable branch deploy/btl-%s.\n' "$sha"
printf 'Confirm its SHA, theme-only path and successful completion. Enter Cloudways deployment ID (empty cancels): '
read -r deployment_id
[[ -n "$deployment_id" ]] || exit 1
printf '%s Cloudways Git SHA=%s deployment=%s\n' "$(date -u +%FT%TZ)" "$sha" "$deployment_id" >> "$BTL_ACTION_LOG"
# Caller independently verifies actual remote SHA and source checksums.
