<?php

$sources = [
    'padi' => __DIR__ . '/../public/assets/images/komoditas/padi.jpg',
    'hero' => __DIR__ . '/../public/assets/images/landing/hero-rice-field.png',
];

foreach ($sources as $name => $path) {
    if (! is_file($path)) {
        echo "$name: missing\n";
        continue;
    }
    $info = getimagesize($path);
    echo "$name: {$info[0]}x{$info[1]} mime={$info['mime']}\n";
}

if (! function_exists('imagewebp')) {
    fwrite(STDERR, "imagewebp not available\n");
    exit(1);
}

function loadImage(string $path)
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

function saveWebpCover($srcImg, int $targetW, int $targetH, string $outPath, int $quality = 82): bool
{
    $srcW = imagesx($srcImg);
    $srcH = imagesy($srcImg);

    $scale = max($targetW / $srcW, $targetH / $srcH);
    $cropW = (int) round($targetW / $scale);
    $cropH = (int) round($targetH / $scale);
    $srcX = (int) max(0, ($srcW - $cropW) / 2);
    $srcY = (int) max(0, ($srcH - $cropH) / 2);

    $dst = imagecreatetruecolor($targetW, $targetH);
    imagecopyresampled($dst, $srcImg, 0, 0, $srcX, $srcY, $targetW, $targetH, $cropW, $cropH);

    $ok = imagewebp($dst, $outPath, $quality);
    imagedestroy($dst);

    return $ok;
}

$sourcePath = __DIR__ . '/../public/assets/images/komoditas/padi.jpg';
[$source, ] = loadImage($sourcePath);

if (! $source) {
    fwrite(STDERR, "Failed to load source image\n");
    exit(1);
}

$outDir = __DIR__ . '/../public/assets/images/landing';
@mkdir($outDir, 0777, true);

$outputs = [
    'bg-sawah.webp' => [1920, 1080, 80],
    'bg-sawah-tablet.webp' => [1280, 720, 78],
    'bg-sawah-mobile.webp' => [768, 1024, 76],
];

foreach ($outputs as $filename => [$w, $h, $q]) {
    $out = $outDir . '/' . $filename;
    if (saveWebpCover($source, $w, $h, $out, $q)) {
        echo "Created {$filename} (" . round(filesize($out) / 1024) . " KB)\n";
    } else {
        echo "Failed {$filename}\n";
    }
}

imagedestroy($source);
