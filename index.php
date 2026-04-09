<?php

define('LARAVEL_START', microtime(true));

$laravelBasePath = __DIR__ . '/laravel';
$vendorPath = $laravelBasePath . '/vendor/autoload.php';
$bootstrapPath = $laravelBasePath . '/bootstrap/app.php';

if (!file_exists($vendorPath)) {
    http_response_code(500);
    die("Error: Missing vendor files at {$vendorPath}");
}

require $vendorPath;

$app = require_once $bootstrapPath;

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
