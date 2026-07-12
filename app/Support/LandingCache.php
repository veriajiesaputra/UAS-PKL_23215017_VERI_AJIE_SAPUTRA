<?php

namespace App\Support;

use App\Models\Gejala;
use App\Models\Hama;
use App\Models\Penyakit;
use App\Models\RiwayatDeteksi;
use Illuminate\Support\Facades\Cache;

class LandingCache
{
    public const STATS_KEY = 'landing.stats';

    public const TTL = 600;

    public static function stats(): array
    {
        return Cache::remember(self::STATS_KEY, self::TTL, fn () => [
            'penyakit' => Penyakit::count(),
            'hama' => Hama::count(),
            'gejala' => Gejala::count(),
            'deteksi' => RiwayatDeteksi::count(),
        ]);
    }

    public static function forgetStats(): void
    {
        Cache::forget(self::STATS_KEY);
    }

    public static function registerInvalidation(): void
    {
        foreach ([Penyakit::class, Hama::class, Gejala::class, RiwayatDeteksi::class] as $model) {
            $model::saved(fn () => self::forgetStats());
            $model::deleted(fn () => self::forgetStats());
        }
    }
}
