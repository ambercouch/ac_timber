"""Local-only deployment guard tests; no real SSH/SFTP connections."""
import ast
import hashlib
import json
from pathlib import Path
import runpy
import shlex
import subprocess
import sys
import tempfile
import unittest
from unittest.mock import patch

SCRIPT = Path(__file__).with_name('deploy.py')

class Guards(unittest.TestCase):
    def setUp(self):
        self.temp = tempfile.TemporaryDirectory()
        self.addCleanup(self.temp.cleanup)
        self.root = Path(self.temp.name)
        tree = ast.parse(SCRIPT.read_text())
        selected = [n for n in tree.body if isinstance(n, (ast.Import, ast.ImportFrom, ast.FunctionDef))
                    or isinstance(n, ast.Assign) and any(isinstance(t, ast.Name) and t.id in ('ASSETS','PRESERVE','METADATA') for t in n.targets)]
        self.ns = {'__file__': str(SCRIPT), 'ROOT': SCRIPT.resolve().parents[2]}
        exec(compile(ast.Module(body=selected, type_ignores=[]), str(SCRIPT), 'exec'), self.ns)
        self.ns['c'] = {'theme_dir': str(self.root), 'git_dir': '/app/git_repo'}
        self.ns['remote'] = lambda cmd: subprocess.check_output(['bash','-c',cmd],text=True).strip()

    def test_only_known_absent_metadata_is_optional(self):
        self.ns['verify_hashes']({'.gitignore':'unused','assets/.gitignore':'unused','templates/.gitignore':'unused'})
        with self.assertRaisesRegex(RuntimeError, 'Remote source mismatch'):
            self.ns['verify_hashes']({'templates/base.twig':'unused'})

    def test_present_metadata_is_still_hashed(self):
        (self.root/'.gitignore').write_text('changed')
        with self.assertRaisesRegex(RuntimeError,'mismatch'):
            self.ns['verify_hashes']({'.gitignore':'wrong'})

    def test_spaced_source_names_and_changed_assets(self):
        (self.root/'a b.php').write_text('source')
        checksum=hashlib.sha256(b'source').hexdigest()
        self.ns['verify_hashes']({'a b.php':checksum})
        (self.root/'style.css').write_text('original')
        state=self.ns['file_state'](('style.css',))
        (self.root/'style.css').write_text('changed')
        with self.assertRaisesRegex(RuntimeError,'Generated file changed'):
            self.ns['verify_preserved'](state,('style.css',))

    def test_git_ownership_exception_is_scoped(self):
        commands=[];self.ns['remote']=lambda cmd:commands.append(cmd) or 'a'*40
        self.ns['remote_sha']()
        self.assertIn('GIT_OPTIONAL_LOCKS=0 git -c safe.directory=/app/git_repo',commands[0])
        self.assertNotIn('--global',commands[0])

    def test_missing_cloudflare_verification_blocks_deployment(self):
        with self.assertRaisesRegex(RuntimeError, 'Deployment blocked'):
            self.ns['require_deployment_clearance']({'url':'https://dev.businesstranslated.com'})

    def test_cloudflare_verification_rejects_wrong_origin_or_unverified_access(self):
        path=self.root/'cloudflare.json'
        config={'url':'https://dev.businesstranslated.com','cloudflare_verification_file':str(path)}
        record={'zone_id':'a'*32,'zone_name':'businesstranslated.com','cache_purge_access_verified':False,'verification_evidence':'mock evidence','allowed_origin':config['url']}
        path.write_text(json.dumps(record));path.chmod(0o600)
        with self.assertRaisesRegex(RuntimeError, 'access must be verified'):
            self.ns['require_deployment_clearance'](config)
        record['cache_purge_access_verified']=True
        record['allowed_origin']='https://businesstranslated.com'
        path.write_text(json.dumps(record))
        with self.assertRaisesRegex(RuntimeError, 'restricted to the staging origin'):
            self.ns['require_deployment_clearance'](config)

    def test_cleanup_prerequisites_and_symlink_guard_prevent_move(self):
        for failure in ('runtime','backup','symlink'):
            with self.subTest(failure=failure):
                release=self.root/failure;release.mkdir()
                assets={}
                for n in ('style.css','style.css.map'):
                    (release/n).write_text('css');assets[n]=hashlib.sha256(b'css').hexdigest()
                (release/'remote-theme-before.tar.gz').write_bytes(b'backup')
                archive_hash=hashlib.sha256(b'backup').hexdigest()
                cfg={'url':'https://dev.businesstranslated.com','ssh_alias':'test', 'ssh_app_root':'/app','wp_root':'/app/public_html','theme_dir':'/app/public_html/wp-content/themes/ac_timber','git_dir':'/app/git_repo','backup_root':'/app/private_html/releases','sftp_theme_dir':'/public_html/wp-content/themes/ac_timber','sftp_backup_root':'/private_html/releases'}
                clearance=self.root/'clearance.json';clearance.write_text(json.dumps({'zone_id':'a'*32,'zone_name':'businesstranslated.com','cache_purge_access_verified':True,'verification_evidence':'mock test evidence','allowed_origin':cfg['url']}));clearance.chmod(0o600)
                cfg['cloudflare_verification_file']=str(clearance)
                conf=self.root/'config.json';conf.write_text(json.dumps(cfg));conf.chmod(0o600)
                (release/'manifest.json').write_text(json.dumps({'sha':'a'*40,'assets':assets,'source':{}}))
                (release/'remote-before.json').write_text(json.dumps({'sha':'b'*40,'source':{},'assets':assets,'generated':{},'backup':'/app/private_html/releases/test','archive_sha256':archive_hash,'target':cfg}))
                commands=[]
                def fake_output(argv,**kwargs):
                    cmd=argv[-1];commands.append(cmd)
                    if cmd.startswith('realpath '):return shlex.split(cmd)[1]+'\n'
                    if 'option get stylesheet' in cmd:return 'ac_timber\n'
                    if 'option get home' in cmd:return cfg['url']+'\n'
                    if ' eval ' in cmd and failure=='runtime':raise subprocess.CalledProcessError(1,argv)
                    if 'theme.tar.gz' in cmd and 'sha256sum' in cmd:return ('0'*64 if failure=='backup' else archive_hash)+'  archive\n'
                    if 'rev-parse HEAD' in cmd:return 'b'*40+'\n'
                    if 'test ! -L /app/public_html/wp-content/themes/ac_timber/lib/acfp' in cmd and failure=='symlink':raise subprocess.CalledProcessError(1,argv)
                    return ''
                with patch.object(sys,'argv',[str(SCRIPT),'cleanup-acf','--config',str(conf),'--release',str(release)]),patch('subprocess.check_output',side_effect=fake_output):
                    with self.assertRaises((RuntimeError,subprocess.CalledProcessError)):
                        runpy.run_path(str(SCRIPT),run_name='__main__')
                self.assertFalse(any(cmd.startswith('mv ') or cmd.startswith('rm ') for cmd in commands))

if __name__ == '__main__':
    unittest.main()
