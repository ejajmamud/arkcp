<?php
// Define absolute path to vendor
$vendorPath = __DIR__.'/../laravel/vendor/autoload.php';

if (!file_exists($vendorPath)) {
    die("Error: Missing vendor files at $vendorPath");
}

// Load Student model directly if needed
if (!class_exists('App\Models\Student')) {
    require __DIR__.'/../laravel/app/Models/Student.php';
    class_alias('App\Models\Student', 'App\Student');
}

define('LARAVEL_START', microtime(true));

require $vendorPath;

$app = require_once __DIR__.'/../laravel/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);