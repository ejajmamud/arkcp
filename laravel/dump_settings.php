<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$settings = DB::table('settings')->first();
echo "Logo: [" . ($settings->logo ?? 'MISSING') . "]\n";
echo "Favicon: [" . ($settings->favicon ?? 'MISSING') . "]\n";
