<?php

$path = __DIR__ . '/../public/assets/images/logos/logo-sipatan.png';
$backup = __DIR__ . '/../public/assets/images/logos/logo-sipatan-with-bg.png';

if (! is_file($path)) {
    fwrite(STDERR, "Logo not found: {$path}\n");
    exit(1);
}

if (! is_file($backup)) {
    copy($path, $backup);
    echo "Backup: logo-sipatan-with-bg.png\n";
}

$info = getimagesize($path);
if ($info === false) {
    fwrite(STDERR, "Cannot read image.\n");
    exit(1);
}

$src = match ($info['mime']) {
    'image/jpeg' => imagecreatefromjpeg($path),
    'image/png' => imagecreatefrompng($path),
    'image/webp' => imagecreatefromwebp($path),
    default => null,
};

if (! $src) {
    fwrite(STDERR, "Failed to load image ({$info['mime']}).\n");
    exit(1);
}

$w = imagesx($src);
$h = imagesy($src);

$dst = imagecreatetruecolor($w, $h);
imagealphablending($dst, false);
imagesavealpha($dst, true);
$transparent = imagecolorallocatealpha($dst, 0, 0, 0, 127);
imagefill($dst, 0, 0, $transparent);
imagealphablending($dst, true);
imagecopy($dst, $src, 0, 0, 0, 0, $w, $h);
imagedestroy($src);
$src = $dst;
imagealphablending($src, false);

function sampleCornerRgb($img, int $w, int $h, int $size = 8): array
{
    $points = [
        [0, 0],
        [$w - $size, 0],
        [0, $h - $size],
        [$w - $size, $h - $size],
    ];

    $r = $g = $b = $n = 0;
    foreach ($points as [$x, $y]) {
        for ($dy = 0; $dy < $size; $dy++) {
            for ($dx = 0; $dx < $size; $dx++) {
                $rgb = imagecolorat($img, min($x + $dx, $w - 1), min($y + $dy, $h - 1));
                $r += ($rgb >> 16) & 0xFF;
                $g += ($rgb >> 8) & 0xFF;
                $b += $rgb & 0xFF;
                $n++;
            }
        }
    }

    return [(int) round($r / $n), (int) round($g / $n), (int) round($b / $n)];
}

[$bgR, $bgG, $bgB] = sampleCornerRgb($src, $w, $h);
echo "Loaded {$info['mime']} {$w}x{$h}, background rgb({$bgR}, {$bgG}, {$bgB})\n";

$tolerance = 42;

for ($y = 0; $y < $h; $y++) {
    for ($x = 0; $x < $w; $x++) {
        $rgb = imagecolorat($src, $x, $y);
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;

        $dist = abs($r - $bgR) + abs($g - $bgG) + abs($b - $bgB);

        if ($dist <= $tolerance) {
            imagesetpixel($src, $x, $y, imagecolorallocatealpha($src, $r, $g, $b, 127));
            continue;
        }

        if ($dist <= $tolerance + 35) {
            $fade = ($dist - $tolerance) / 35;
            $alpha = (int) round(127 * (1 - $fade));
            imagesetpixel($src, $x, $y, imagecolorallocatealpha($src, $r, $g, $b, max(0, min(127, $alpha))));
        }
    }
}

imagepng($src, $path, 9);
imagedestroy($src);

echo "Saved transparent PNG: logo-sipatan.png (" . round(filesize($path) / 1024, 1) . " KB)\n";
