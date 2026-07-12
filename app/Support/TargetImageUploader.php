<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use InvalidArgumentException;

class TargetImageUploader
{
    private const ALLOWED_EXTENSIONS = ['jpg', 'jpeg', 'png', 'webp'];

    public static function store(UploadedFile $file, string $prefix): string
    {
        $extension = strtolower($file->getClientOriginalExtension());

        if (! in_array($extension, self::ALLOWED_EXTENSIONS, true)) {
            $extension = match ($file->getMimeType()) {
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                'image/webp' => 'webp',
                default => throw new InvalidArgumentException('Format gambar tidak didukung.'),
            };
        }

        $dir = public_path('assets/images/targets');
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $safePrefix = preg_replace('/[^a-z0-9-]/', '', strtolower($prefix)) ?: 'target';
        $filename = $safePrefix.'-'.bin2hex(random_bytes(8)).'.'.$extension;

        $file->move($dir, $filename);

        return 'assets/images/targets/'.$filename;
    }

    public static function delete(?string $path): void
    {
        if (! $path) {
            return;
        }

        if (! str_starts_with($path, 'assets/images/targets/')) {
            return;
        }

        $full = public_path($path);
        if (is_file($full)) {
            unlink($full);
        }
    }
}
