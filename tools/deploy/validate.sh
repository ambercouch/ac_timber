#!/usr/bin/env bash
set -euo pipefail
[[ ${1:-} = https://dev.businesstranslated.com ]] || exit 2
output_dir=${2:?Expected report output directory}
script_dir=$(cd -- "$(dirname -- "${BASH_SOURCE[0]}")" && pwd)
source "$HOME/.nvm/nvm.sh"
nvm use 24
if [[ $(basename -- "$output_dir") = rollback-validation ]]; then
  exec node "$script_dir/validate.mjs" "$1" "$output_dir" --baseline
else
  exec node "$script_dir/validate.mjs" "$1" "$output_dir" "$(dirname -- "$output_dir")/manifest.json"
fi
