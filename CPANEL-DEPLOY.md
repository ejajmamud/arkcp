## cPanel Deploy Notes

- This repository now includes `laravel/vendor/`, so a plain cPanel Git clone can boot without running Composer.
- Production secrets are not committed. Upload your local `laravel/.env.production` through cPanel File Manager after cloning.
- If `laravel/.env` is missing, the app will automatically load `laravel/.env.production`.
- Set the web root to `laravel/public` when possible.
- If PDF download should use a browser engine on Linux hosting, set `BROWSER_PDF_BIN` in `laravel/.env.production` to a valid Chrome/Chromium path.
- If no browser binary exists on the host, the app will fall back to DOMPDF.
