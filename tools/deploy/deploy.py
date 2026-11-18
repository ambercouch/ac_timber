#!/usr/bin/env python3
"""Staging-only, explicit phase deployment. No command commits or pushes."""
import argparse
import hashlib
import json
import os
from pathlib import Path
import re
import shlex
import subprocess
import sys
import tarfile

ROOT = Path(__file__).resolve().parents[2]
ASSETS = ('style.css', 'style.css.map')
PRESERVE = ('assets/scss/_vendor.scss', 'dist/js/main.js', 'templates/inc/defs.svg')
METADATA = frozenset(('.gitignore', 'assets/.gitignore', 'templates/.gitignore'))
ACF = 'dc0797b1fcc39fd99537d38384f3ae0a854673ea'

def run(args, **kwargs):
    return subprocess.run(args, check=True, text=True, **kwargs)

def output(args, **kwargs):
    return subprocess.check_output(args, text=True, **kwargs).strip()

def git(*args):
    return output(['git', '-C', str(ROOT), *args])

def digest(path):
    return hashlib.sha256(Path(path).read_bytes()).hexdigest()

def require(ok, message):
    if not ok:
        raise RuntimeError(message)

def write(path, obj):
    path.write_text(json.dumps(obj, indent=2) + '\n')

def require_deployment_clearance(config):
    """A private, reviewed verification record is required before any remote write."""
    location = config.get('cloudflare_verification_file')
    require(isinstance(location, str) and location, 'Deployment blocked: Cloudflare zone/access verification is missing')
    path = Path(location).expanduser().resolve()
    require(not path.is_relative_to(ROOT), 'Verification record must remain outside Git')
    require(path.is_file() and path.stat().st_mode & 0o077 == 0, 'Verification record must exist with private permissions')
    record = json.loads(path.read_text())
    require(re.fullmatch(r'[0-9a-f]{32}', record.get('zone_id', '')), 'Verified Cloudflare zone ID required')
    require(record.get('zone_name') == 'businesstranslated.com', 'Unexpected Cloudflare zone')
    require(record.get('cache_purge_access_verified') is True and bool(record.get('verification_evidence')), 'Zone-scoped Cache Purge access must be verified and documented')
    require(record.get('allowed_origin') == config['url'], 'Purges must be restricted to the staging origin')

p = argparse.ArgumentParser(description=__doc__)
p.add_argument('phase', choices=['build', 'backup', 'deploy-source', 'cleanup-acf', 'upload', 'finish', 'rollback'])
p.add_argument('--config', required=True, type=Path)
p.add_argument('--release', required=True, type=Path)
p.add_argument('--sha', help='Full committed SHA; build phase only')
a = p.parse_args()
c = json.loads(a.config.read_text())
require(c['url'] == 'https://dev.businesstranslated.com', 'Only the development URL is allowed')
require(a.config.stat().st_mode & 0o077 == 0, 'Local config must be chmod 600')
require(not a.config.resolve().is_relative_to(ROOT), 'Config must be outside theme repository')
if a.phase != 'build':
    require_deployment_clearance(c)
r = a.release.resolve()
require(not r.is_relative_to(ROOT), 'Release directory must be outside theme repository')
# Shell paths and SSH alias are deliberately restricted, not interpolated from arbitrary text.
for key in ('theme_dir', 'wp_root', 'git_dir', 'backup_root', 'ssh_app_root', 'sftp_theme_dir', 'sftp_backup_root'):
    require(re.fullmatch(r'/[A-Za-z0-9_./-]+', c[key]) and '..' not in c[key].split('/'), 'Invalid remote path: ' + key)
require(c['wp_root'] == c['ssh_app_root'] + '/public_html', 'Unexpected application root')
require(c['backup_root'].startswith(c['ssh_app_root'] + '/private_html/'), 'Backup root must be private to this application')
require(c['sftp_theme_dir'] == c['theme_dir'].removeprefix(c['ssh_app_root']), 'SFTP theme mapping differs')
require(c['sftp_backup_root'] == c['backup_root'].removeprefix(c['ssh_app_root']), 'SFTP backup mapping differs')
require(c['theme_dir'] == c['wp_root'] + '/wp-content/themes/ac_timber', 'Unexpected theme directory')
require(not c['backup_root'].startswith(c['wp_root'] + '/'), 'Backups must be outside public_html')
require(re.fullmatch(r'[A-Za-z0-9_-]+', c['ssh_alias']), 'Use an SSH config alias')
ssh = ['ssh', '-oBatchMode=yes', '-oStrictHostKeyChecking=yes', c['ssh_alias']]

def remote(command):
    return output(ssh + [command])

def hook(key, *args):
    command = c.get(key)
    require(isinstance(command, list) and command and Path(command[0]).is_absolute(), 'Configure local executable argv: ' + key)
    run(command + list(args))

def remote_sha():
    return remote('GIT_OPTIONAL_LOCKS=0 git -c safe.directory=' + shlex.quote(c['git_dir']) + ' -C ' + shlex.quote(c['git_dir']) + ' rev-parse HEAD')

def preflight():
    for path in (c['ssh_app_root'], c['ssh_app_root'] + '/private_html', c['wp_root'], c['theme_dir'], c['git_dir']):
        require(remote('realpath ' + shlex.quote(path)) == path, 'Remote path is redirected or symlinked')
    remote('test ! -L ' + c['backup_root'] + ' && { test ! -e ' + c['backup_root'] + ' || test "$(realpath ' + c['backup_root'] + ')" = ' + c['backup_root'] + '; }')
    wp = 'wp --path=' + shlex.quote(c['wp_root'])
    require(remote(wp + ' option get stylesheet') == 'ac_timber', 'Active theme differs')
    require(remote(wp + ' option get home').rstrip('/') == c['url'], 'Remote home URL differs')
    remote(wp + ' plugin is-active advanced-custom-fields-pro')
    remote(wp + ' eval ' + shlex.quote("$p=wp_normalize_path(WP_PLUGIN_DIR . '/advanced-custom-fields-pro/'); if (!function_exists('acf_get_setting') || !acf_get_setting('pro') || wp_normalize_path(acf_get_setting('path')) !== $p || strpos(wp_normalize_path((new ReflectionFunction('acf_get_setting'))->getFileName()), $p) !== 0) { exit(1); }"))

def verify_source(sha, expected):
    require(remote_sha() == sha, 'Cloudways Git HEAD does not match requested SHA')
    verify_hashes(expected)
    require(remote('test ! -e ' + shlex.quote(c['theme_dir'] + '/lib/acfp') + ' && echo absent') == 'absent', 'Old bundled ACF remains')

def verify_hashes(expected):
    names = list(expected)
    for start in range(0, len(names), 100):
        batch = names[start:start + 100]
        require(all(re.fullmatch(r'[A-Za-z0-9_./ -]+', n) and '..' not in n.split('/') and not n.startswith('/') for n in batch), 'Invalid source paths')
        command = ('set -e; cd ' + c['theme_dir'] + '; for file in '
                   + ' '.join(shlex.quote(n) for n in batch)
                   + r"""; do if [ ! -e "$file" ] && [ ! -L "$file" ]; then printf 'MISSING %s\n' "$file"; else sha256sum -- "$file"; fi; done""")
        lines = remote(command).splitlines()
        actual = {}
        missing = set()
        for line in lines:
            if line.startswith('MISSING '):
                missing.add(line[8:])
            else:
                checksum, name = line.split(maxsplit=1)
                actual[name.lstrip(' *')] = checksum
        for name in batch:
            if name in missing and name in METADATA:
                continue
            require(actual.get(name) == expected[name], 'Remote source mismatch: ' + name)

def source_hashes(sha):
    names = git('ls-tree', '-r', '--name-only', sha).splitlines()
    require(all(re.fullmatch(r'[A-Za-z0-9_./ -]+', n) for n in names), 'Unsupported source filename')
    return {n: hashlib.sha256(subprocess.check_output(['git', '-C', str(ROOT), 'show', sha + ':' + n])).hexdigest() for n in names}

if a.phase == 'build':
    require(a.sha and re.fullmatch(r'[0-9a-f]{40}', a.sha), 'Supply full --sha')
    require(git('rev-parse', 'HEAD') == a.sha and not git('status', '--porcelain'), 'Build requires clean checkout at requested SHA')
    run(['git', '-C', str(ROOT), 'merge-base', '--is-ancestor', ACF, a.sha])
    require(not r.exists(), 'Use a new release directory')
    r.mkdir(parents=True, mode=0o700)
    # Build an exported committed tree, never dirty working files or stale ignored assets.
    archive = r / 'source.tar'
    run(['git', '-C', str(ROOT), 'archive', '--format=tar', '-o', str(archive), a.sha])
    work = r / 'build'
    work.mkdir()
    with tarfile.open(archive) as t:
        t.extractall(work, filter='data')
    # Preserve current generated CSS for reference; do not overwrite the local site build.
    previous = r / 'local-before'; previous.mkdir()
    for name in ASSETS:
        if (ROOT / name).exists():
            (previous / name).write_bytes((ROOT / name).read_bytes())
    script = '''set -euo pipefail
source "$HOME/.nvm/nvm.sh"
nvm use 10.24.1
[ "$(node --version)" = v10.24.1 ]
[ "$(npm --version)" = 6.14.12 ]
npm ci
./node_modules/.bin/gulp vendorStyles
./node_modules/.bin/gulp styles
'''
    with (r / 'build.log').open('w') as log:
        run(['bash', '-c', script], cwd=work, stdout=log, stderr=subprocess.STDOUT)
    log = (r / 'build.log').read_text()
    require(not re.search(r'(^|\n).*?(Error:|SassError|error in plugin)', log, re.I), 'Inspect build.log: build logged an error')
    for name in ASSETS:
        require((work / name).stat().st_size > 0, 'Missing generated file ' + name)
        (r / name).write_bytes((work / name).read_bytes())
    require('#1f4e4a' in (r / 'style.css').read_text().lower(), 'Expected palette absent; inspect CSS')
    write(r / 'manifest.json', {'sha': a.sha, 'node': '10.24.1', 'npm': '6.14.12', 'assets': {n: digest(r / n) for n in ASSETS}, 'source': source_hashes(a.sha)})
    print('Built release. Review build.log, CSS, manifest and local browser validation before backup/deploy.')
    sys.exit()

m = json.loads((r / 'manifest.json').read_text())
require(re.fullmatch(r'[0-9a-f]{40}', m['sha']), 'Invalid release SHA')
require(set(m['assets']) == set(ASSETS), 'Asset allowlist mismatch')
for name in ASSETS:
    require(digest(r / name) == m['assets'][name], 'Release asset changed')
backup = c['backup_root'] + '/btl-' + m['sha']
sftp_backup = c['sftp_backup_root'] + '/btl-' + m['sha']
TARGET_KEYS = ('ssh_alias','ssh_app_root','theme_dir','wp_root','git_dir','backup_root','sftp_theme_dir','sftp_backup_root','url')

def file_state(names):
    state = {}
    for name in names:
        path = c['theme_dir'] + '/' + name
        remote('test -f ' + path + ' && test ! -L ' + path)
        state[name] = {'sha256': remote('sha256sum ' + path).split()[0], 'mode': remote("stat -c '%a' " + path)}
    return state

def verify_preserved(state, names):
    for name in names:
        require(file_state((name,))[name] == state[name], 'Generated file changed or disappeared: ' + name)

def verify_backup(state):
    archive = state['backup'] + '/theme.tar.gz'
    require(remote('sha256sum ' + archive).split()[0] == state['archive_sha256'], 'Remote backup changed')
    require(digest(r / 'remote-theme-before.tar.gz') == state['archive_sha256'], 'Local backup changed')
state_file = r / 'remote-before.json'

if a.phase == 'backup':
    require(not state_file.exists(), 'Backup already recorded; do not overwrite')
    preflight()
    before = remote_sha()
    require(re.fullmatch(r'[0-9a-f]{40}', before), 'Cannot establish previous source revision')
    # Require prior revision locally so Cloudways source rollback can be pinned and reviewed.
    prior_source = source_hashes(before)
    verify_hashes(prior_source)
    generated = file_state(ASSETS + PRESERVE)
    hashes = {n: remote('sha256sum ' + shlex.quote(c['theme_dir'] + '/' + n)).split()[0] for n in ASSETS}
    # Full theme archive includes baseline JS/SVG and any untracked theme files; no DB/config.
    remote('umask 077; mkdir -p ' + c['backup_root'] + '; mkdir ' + backup + ' && tar --exclude=.git --exclude=node_modules -czf ' + backup + '/theme.tar.gz -C ' + c['theme_dir'] + ' .')
    archive_hash = remote('sha256sum ' + backup + '/theme.tar.gz').split()[0]
    batch = r / 'backup-download.batch'
    batch.write_text('get ' + json.dumps(sftp_backup + '/theme.tar.gz') + ' ' + json.dumps(str(r / 'remote-theme-before.tar.gz')) + '\n')
    run(['sftp', '-oBatchMode=yes', '-oStrictHostKeyChecking=yes', '-b', str(batch), c['ssh_alias']])
    require(digest(r / 'remote-theme-before.tar.gz') == archive_hash, 'Downloaded backup checksum mismatch')
    require(remote_sha() == before, 'Remote revision changed during backup')
    verify_preserved(generated, ASSETS + PRESERVE)
    verify_hashes(prior_source)
    write(state_file, {'sha': before, 'source': prior_source, 'assets': hashes, 'generated': generated, 'backup': backup, 'archive_sha256': archive_hash, 'target': {k: c[k] for k in TARGET_KEYS}})
    print('Backup recorded. Confirm Cloudways Git deployment scope/deletions and cache hooks before proceeding.')
elif a.phase in ('deploy-source', 'cleanup-acf', 'upload', 'finish', 'rollback'):
    s = json.loads(state_file.read_text())
    require(s['target'] == {k: c[k] for k in s['target']}, 'Config target changed since backup')
    preflight()
    if a.phase == 'cleanup-acf':
        verify_backup(s)
        require(remote_sha() in (s['sha'], m['sha']), 'Unexpected remote revision')
        require(not any(n == 'lib/acfp' or n.startswith('lib/acfp/') for n in (*s['source'], *m['source'])), 'Bundled ACF still tracked by a rollback/release revision')
        old = c['theme_dir'] + '/lib/acfp'
        # Exact allowlisted subtree only; reject symlinked parents/root and redirected backups.
        remote('test ! -L ' + old + ' && test -d ' + old + ' && test "$(realpath ' + c['theme_dir'] + '/lib)" = ' + c['theme_dir'] + '/lib && test "$(realpath ' + old + ')" = ' + old + ' && test "$(realpath ' + s['backup'] + ')" = ' + s['backup'])
        require(remote('test ! -e ' + s['backup'] + '/obsolete-acfp && echo clear') == 'clear', 'Quarantine exists')
        verify_preserved(s['generated'], ASSETS + PRESERVE)
        remote('tar -dzf ' + s['backup'] + '/theme.tar.gz -C ' + c['theme_dir'] + ' ./lib/acfp')
        remote('mv -- ' + old + ' ' + s['backup'] + '/obsolete-acfp')
        (r / 'acf-quarantined').write_text(s['backup'])
        preflight()
        print('Only lib/acfp moved into the verified private backup; standalone runtime rechecked.')
    elif a.phase == 'deploy-source':
        verify_backup(s)
        verify_preserved(s['generated'], ASSETS + PRESERVE)
        require(remote_sha() == s['sha'], 'Remote changed since backup')
        # Hook must deploy via Cloudways Git, wait for completion and record deployment ID.
        hook('cloudways_git_hook', m['sha'])
        verify_source(m['sha'], m['source'])
        verify_preserved(s['generated'], ASSETS + PRESERVE)
        (r / 'source-verified').write_text(m['sha'])
    elif a.phase == 'upload':
        require((r / 'source-verified').read_text() == m['sha'], 'Deploy source first')
        verify_source(m['sha'], m['source'])
        require(not (r / 'uploaded').exists(), 'Release assets already uploaded')
        verify_preserved(s['generated'], ASSETS + PRESERVE)
        for name in ASSETS:
            temporary = c['theme_dir'] + '/' + name + '.btl-new'
            remote('test ! -e ' + temporary + ' && test ! -L ' + temporary)
        commands = []
        for name in ASSETS:
            commands.append('put ' + json.dumps(str(r / name)) + ' ' + json.dumps(c['sftp_theme_dir'] + '/' + name + '.btl-new'))
        batch = r / 'sftp.batch'; batch.write_text('\n'.join(commands) + '\n')
        run(['sftp', '-oBatchMode=yes', '-oStrictHostKeyChecking=yes', '-b', str(batch), c['ssh_alias']])
        for name in ASSETS:
            require(remote('sha256sum ' + c['theme_dir'] + '/' + name + '.btl-new').split()[0] == m['assets'][name], 'Uploaded checksum mismatch')
        for name in ASSETS:
            require(re.fullmatch(r'[0-7]{3,4}', s['generated'][name]['mode']), 'Invalid stored file mode')
            remote('chmod ' + s['generated'][name]['mode'] + ' ' + c['theme_dir'] + '/' + name + '.btl-new')
        remote('set -e; ' + '; '.join('mv ' + c['theme_dir'] + '/' + n + '.btl-new ' + c['theme_dir'] + '/' + n for n in ASSETS))
        (r / 'uploaded').write_text(m['sha'])
    elif a.phase == 'finish':
        require((r / 'uploaded').read_text() == m['sha'], 'Upload assets first')
        verify_source(m['sha'], m['source'])
        for name in ASSETS:
            require(remote('sha256sum ' + c['theme_dir'] + '/' + name).split()[0] == m['assets'][name], 'Remote asset drift')
        verify_preserved(s['generated'], PRESERVE)
        hook('purge_hook', c['url'])
        hook('validate_hook', c['url'], str(r / 'validation'))
        print('Validation executed. Inspect screenshots and report before signing off release.')
    else:
        verify_backup(s)
        # Re-deploy old source THROUGH Cloudways, not git reset or a DB restore.
        hook('cloudways_git_hook', s['sha'])
        require(remote_sha() == s['sha'], 'Rollback source SHA mismatch')
        verify_hashes(s['source'])
        remote('tar -xzf ' + s['backup'] + '/theme.tar.gz -C ' + c['theme_dir'] + ' ./style.css ./style.css.map ./assets/scss/_vendor.scss ./dist/js/main.js ./templates/inc/defs.svg')
        for name in ASSETS + PRESERVE:
            require(re.fullmatch(r'[0-7]{3,4}', s['generated'][name]['mode']), 'Invalid stored file mode')
            remote('chmod ' + s['generated'][name]['mode'] + ' ' + c['theme_dir'] + '/' + name)
        verify_preserved(s['generated'], ASSETS + PRESERVE)
        hook('purge_hook', c['url'])
        hook('validate_hook', c['url'], str(r / 'rollback-validation'))
        print('Previous source and CSS restored. Inspect rollback screenshots and report.')
