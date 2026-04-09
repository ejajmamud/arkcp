<?php
$path = 'c:\Users\EJAJ\Downloads\cptest.ark.com.my\cptest.ark.com.my\laravel\public\img\report_hex.png';
if (file_exists($path)) {
    $img = imagecreatefrompng($path);
    if ($img) {
        imagepng($img, $path);
        imagedestroy($img);
        echo "Image sanitized.";
    } else {
        echo "Failed to load image.";
    }
} else {
    echo "File not found.";
}
