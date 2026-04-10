# FTP DEPLOYMENT GUIDE - A4 Narrow Margins Fix

## 📦 Files to Deploy

Both files are ready in: `c:\xampp\htdocs\arkcp\DEPLOY_FILES\`

### File 1: `index.blade.php`
- **Source:** `DEPLOY_FILES\index.blade.php` 
- **Upload to:** `/public_html/cptest.ark.com.my/laravel/resources/views/testsuccess/index.blade.php`
- **Size:** 38 KB

### File 2: `TestController.php`
- **Source:** `DEPLOY_FILES\TestController.php`
- **Upload to:** `/public_html/cptest.ark.com.my/laravel/app/Http/Controllers/TestController.php`
- **Size:** 14 KB

---

## 🔐 FTP Connection Details

- **Host:** cptest.ark.com.my
- **Port:** 21
- **Username:** arkcom
- **Password:** commonSSH@5005
- **Base Directory:** `/public_html/cptest.ark.com.my/`

---

## 📋 Step-by-Step FTP Upload Instructions

### Using FileZilla (Recommended)

1. **Open FileZilla**
2. **File → Site Manager** (or Ctrl+S)
3. **Create New Site:**
   - Host: `cptest.ark.com.my`
   - Port: `21`
   - Protocol: `FTP`
   - Encryption: `Use explicit FTP over TLS if available`
   - Username: `arkcom`
   - Password: `commonSSH@5005`
4. **Connect**
5. **Navigate to:** `/public_html/cptest.ark.com.my/`
6. **Upload File 1:** `index.blade.php`
   - Drag `DEPLOY_FILES\index.blade.php` to FTP panel
   - Navigate to `/laravel/resources/views/testsuccess/` on server
   - Drop the file
7. **Upload File 2:** `TestController.php`
   - Drag `DEPLOY_FILES\TestController.php` to FTP panel
   - Navigate to `/laravel/app/Http/Controllers/` on server
   - Drop the file

### Using WinSCP

1. **Open WinSCP**
2. **New Site:**
   - Host name: `cptest.ark.com.my`
   - Port: `21`
   - User name: `arkcom`
   - Password: `commonSSH@5005`
   - File protocol: `FTP`
3. **Login**
4. **Local panel:** Navigate to `c:\xampp\htdocs\arkcp\DEPLOY_FILES\`
5. **Remote panel:** Navigate to `/public_html/cptest.ark.com.my/`
6. **Upload index.blade.php:**
   - Double-click `index.blade.php` in local panel
   - Navigate to `laravel/resources/views/testsuccess/` on remote
   - Upload
7. **Upload TestController.php:**
   - Double-click `TestController.php` in local panel
   - Navigate to `laravel/app/Http/Controllers/` on remote
   - Upload

### Using Command Line (FTP)

```batch
ftp cptest.ark.com.my
# Enter username: arkcom
# Enter password: commonSSH@5005
cd public_html/cptest.ark.com.my/laravel/resources/views/testsuccess/
binary
put "c:\xampp\htdocs\arkcp\DEPLOY_FILES\index.blade.php"
cd ..\..\..\..\app\Http\Controllers\
put "c:\xampp\htdocs\arkcp\DEPLOY_FILES\TestController.php"
quit
```

---

## 🔄 After Upload - Clear Cache

Once both files are uploaded, you MUST clear the Laravel cache on the server.

### Option A: Via SSH (if available)

```bash
cd /home/arkcom/public_html/cptest.ark.com.my/laravel
php artisan cache:clear
php artisan view:clear
php artisan config:clear
```

### Option B: Upload cache-clear script via FTP

Create a file `clear-cache.php` in `/public_html/cptest.ark.com.my/` with this content:

```php
<?php
define('LARAVEL_START', microtime(true));
require __DIR__.'/laravel/bootstrap/autoload.php';
$app = require __DIR__.'/laravel/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->call('cache:clear');
$kernel->call('view:clear');
$kernel->call('config:clear');
echo "✅ Cache cleared successfully!";
?>
```

Then visit: `https://cptest.ark.com.my/clear-cache.php`

### Option C: Delete cache files manually via FTP

Navigate to `/public_html/cptest.ark.com.my/laravel/storage/framework/cache/` and delete all files.

---

## ✅ Verification

After deployment and cache clearing, test by:

1. Go to: `https://cptest.ark.com.my/test/success?uid=uUuyw`
2. Click "Download Report"
3. Open the PDF and verify:
   - ✅ No right-side cropping
   - ✅ Text fits on A4 page
   - ✅ 10mm margins on all sides
   - ✅ Occupation list displays in 2 columns
   - ✅ Layout matches web preview
   - ✅ All images visible

---

## 📊 Changes Summary

**GitHub Commit:** `b2ca85b`

### What Was Fixed:
- ✅ A4 page size with standard 10mm narrow margins
- ✅ Removed padding that caused right-side cropping
- ✅ Improved table layout calculation
- ✅ All content now fits within page bounds
- ✅ Consistent spacing and margins

---

## 🆘 Troubleshooting

**PDFs still cropped after deployment?**
- Ensure cache was cleared
- Verify both files uploaded successfully
- Check file sizes match expected (38 KB, 14 KB)
- Try a fresh PDF download (not browser cache)

**Can't connect to FTP?**
- Check username/password
- Verify port 21 is open
- Try explicit TLS encryption
- Contact hosting provider for firewall issues

**Wrong files uploaded?**
- Delete incorrect files from server via FTP
- Re-upload from DEPLOY_FILES folder
- Clear cache again

---

## 📞 Support

For issues:
1. Check Laravel logs at: `/laravel/storage/logs/laravel.log`
2. Check DomPDF logs at: `/laravel/storage/logs/dompdf.log`
3. Verify file permissions (should be 644 for .php files)
4. Ensure `/laravel/storage/` directory is writable

---

**Status:** ✅ Ready for deployment  
**Last Updated:** 2026-04-10  
**All files available in:** `c:\xampp\htdocs\arkcp\DEPLOY_FILES\`
