<?php

$source = __DIR__ . '/../public/assets/images/logos/logo-sipatan.png';
$outDir = __DIR__ . '/../public/assets/images';

if (! is_file($source)) {
    fwrite(STDERR, "Logo not found: {$source}\n");
    exit(1);
}

$src = imagecreatefrompng($source);
if (! $src) {
    fwrite(STDERR, "Failed to load logo PNG.\n");
    exit(1);
}

imagesavealpha($src, true);

function saveFavicon($src, int $size, string $path): void
{
    $srcW = imagesx($src);
    $srcH = imagesy($src);

    $dst = imagecreatetruecolor($size, $size);
    imagealphablending($dst, false);
    imagesavealpha($dst, true);
    $transparent = imagecolorallocatealpha($dst, 0, 0, 0, 127);
    imagefill($dst, 0, 0, $transparent);
    imagealphablending($dst, true);

    $scale = min($size / $srcW, $size / $srcH) * 0.92;
    $dstW = (int) round($srcW * $scale);
    $dstH = (int) round($srcH * $scale);
    $dstX = (int) round(($size - $dstW) / 2);
    $dstY = (int) round(($size - $dstH) / 2);

    imagecopyresampled($dst, $src, $dstX, $dstY, 0, 0, $dstW, $dstH, $srcW, $srcH);
    imagepng($dst, $path, 9);
    imagedestroy($dst);

    echo basename($path) . " ({$size}x{$size}, " . round(filesize($path) / 1024, 1) . " KB)\n";
}

$sizes = [
    'favicon-16x16.png' => 16,
    'favicon-32x32.png' => 32,
    'apple-touch-icon.png' => 180,
    'android-chrome-192x192.png' => 192,
    'android-chrome-512x512.png' => 512,
];

foreach ($sizes as $filename => $size) {
    saveFavicon($src, $size, $outDir . '/' . $filename);
}

imagedestroy($src);
echo "Done.\n";
