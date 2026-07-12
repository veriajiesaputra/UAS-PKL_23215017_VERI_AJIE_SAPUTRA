<?php

$path = __DIR__ . '/../public/assets/images/logos/logo-sipatan.png';
$maxSize = 512;

$info = getimagesize($path);
if ($info === false || $info['mime'] !== 'image/png') {
    fwrite(STDERR, "Expected PNG at {$path}\n");
    exit(1);
}

$src = imagecreatefrompng($path);
$w = imagesx($src);
$h = imagesy($src);

if ($w <= $maxSize && $h <= $maxSize) {
    imagedestroy($src);
    echo "Already within {$maxSize}px\n";
    exit(0);
}

$scale = min($maxSize / $w, $maxSize / $h);
$newW = (int) round($w * $scale);
$newH = (int) round($h * $scale);

$dst = imagecreatetruecolor($newW, $newH);
imagealphablending($dst, false);
imagesavealpha($dst, true);
$transparent = imagecolorallocatealpha($dst, 0, 0, 0, 127);
imagefill($dst, 0, 0, $transparent);
imagecopyresampled($dst, $src, 0, 0, 0, 0, $newW, $newH, $w, $h);
imagedestroy($src);

imagepng($dst, $path, 9);
imagedestroy($dst);

echo "Resized to {$newW}x{$newH} (" . round(filesize($path) / 1024, 1) . " KB)\n";
