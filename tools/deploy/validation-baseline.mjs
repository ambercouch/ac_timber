import { createHash } from 'node:crypto';

// Verified on staging before deployment. Fingerprint includes the entire request
// (including all query values), without storing API keys in source or reports.
export const COOKIE_CONTROL_REQUEST = '2480111d917020c3250c5982456c02dcaaddc5a2b9f4982e8514f6c6839ddaf2';
const ENDPOINT = 'https://apikeys.civiccomputing.com/c/v';
const SCRIPT = 'https://cc.cdn.civiccomputing.com/9/cookieControl-9.x.min.js';
const SCRIPT_FINGERPRINT = '3f797380b2f1d5bfb500ff2b38b12f9919f253e5fc472877f96cee56d1df0fb0';
export const SETTINGS_ERROR = 'Cookie Control failed to verify your settings.\nPlease refer to https://www.civicuk.com/cookie-control/documentation.';
export const RESOURCE_ERROR = 'Failed to load resource: the server responded with a status of 400 ()';

export function requestFingerprint(value) {
  try {
    const url = new URL(value);
    url.searchParams.sort();
    return createHash('sha256').update(url.href).digest('hex');
  } catch { return null; }
}

export function diagnosticUrl(value) {
  try { const url = new URL(value); return url.origin + url.pathname; }
  catch { return ''; }
}

export function classifyCookieControlDiagnostics(httpErrors, consoleMessages) {
  const knownHttp = entry => entry.status === 400 && entry.url === ENDPOINT
    && entry.requestFingerprint === COOKIE_CONTROL_REQUEST && entry.resourceType === 'xhr';
  const corroborated = httpErrors.some(knownHttp);
  const knownConsole = entry => corroborated && entry.type === 'error' && entry.line === 0 && (
    (entry.text === RESOURCE_ERROR && entry.url === ENDPOINT && entry.column === 0
      && entry.requestFingerprint === COOKIE_CONTROL_REQUEST)
    || (entry.text === SETTINGS_ERROR && entry.url === SCRIPT && entry.column === 71200
      && entry.requestFingerprint === SCRIPT_FINGERPRINT)
  );
  const annotate = (entry, known) => ({...entry,
    classification: known ? 'known-baseline' : 'unexpected',
    ...(known ? {baselineIssue: 'cookie-control-settings-verification'} : {}),
  });
  return {
    httpErrors: httpErrors.map(entry => annotate(entry, knownHttp(entry))),
    console: consoleMessages.map(entry => annotate(entry, knownConsole(entry))),
  };
}

export function unexpectedDiagnostics(entries) {
  return entries.some(entry => entry.classification !== 'known-baseline');
}
