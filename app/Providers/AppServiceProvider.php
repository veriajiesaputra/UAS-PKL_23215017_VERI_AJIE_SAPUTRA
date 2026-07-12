<?php

namespace App\Providers;

use App\Support\LandingCache;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();
        LandingCache::registerInvalidation();
    }
}
