<?php

/**
 * Convert large landing PNG illustrations to optimized WebP (max width, aspect preserved).
 * Usage: php scripts/convert-landing-images.php
 */

if (! function_exists('imagewebp')) {
    fwrite(STDERR, "GD imagewebp not available. Enable GD with WebP support.\n");
    exit(1);
}

function loadImage(string $path): array
{
    $info = getimagesize($path);
    if ($info === false) {
        return [null, null];
    }

    $img = match ($info['mime']) {
        'image/jpeg' => imagecreatefromjpeg($path),
        'image/png' => imagecreatefrompng($path),
        'image/webp' => imagecreatefromwebp($path),
        default => null,
    };

    return [$img, $info];
}

function saveWebpFit($srcImg, int $maxWidth, string $outPath, int $quality = 82): bool
{
    $srcW = imagesx($srcImg);
    $srcH = imagesy($srcImg);

    if ($srcW <= $maxWidth) {
        $dstW = $srcW;
        $dstH = $srcH;
    } else {
        $dstW = $maxWidth;
        $dstH = (int) round($srcH * ($maxWidth / $srcW));
    }

    $dst = imagecreatetruecolor($dstW, $dstH);
    imagealphablending($dst, false);
    imagesavealpha($dst, true);
    $transparent = imagecolorallocatealpha($dst, 0, 0, 0, 127);
    imagefill($dst, 0, 0, $transparent);
    imagealphablending($dst, true);

    imagecopyresampled($dst, $srcImg, 0, 0, 0, 0, $dstW, $dstH, $srcW, $srcH);

    $ok = imagewebp($dst, $outPath, $quality);
    imagedestroy($dst);

    return $ok;
}

$baseDir = __DIR__ . '/../public/assets/images/landing';

$images = [
    'hero-petani.jpg' => ['maxWidth' => 800, 'quality' => 82],
    'hero-rice-field.png' => ['maxWidth' => 800, 'quality' => 82],
    'feature-deteksi.png' => ['maxWidth' => 800, 'quality' => 82],
    'poster-penyakit-padi.png' => ['maxWidth' => 800, 'quality' => 82],
];

foreach ($images as $filename => $opts) {
    $srcPath = $baseDir . '/' . $filename;

    if (! is_file($srcPath)) {
        echo "Skip (missing): {$filename}\n";
        continue;
    }

    $webpName = preg_replace('/\.(png|jpe?g)$/i', '.webp', $filename);
    $outPath = $baseDir . '/' . $webpName;

    [$img, $info] = loadImage($srcPath);
    if (! $img) {
        echo "Failed to load: {$filename}\n";
        continue;
    }

    $srcKb = round(filesize($srcPath) / 1024);
    echo "{$filename}: {$info[0]}x{$info[1]} ({$srcKb} KB) -> ";

    if (saveWebpFit($img, $opts['maxWidth'], $outPath, $opts['quality'])) {
        $outInfo = getimagesize($outPath);
        $outKb = round(filesize($outPath) / 1024);
        echo "{$webpName}: {$outInfo[0]}x{$outInfo[1]} ({$outKb} KB)\n";
    } else {
        echo "FAILED\n";
    }

    imagedestroy($img);
}
