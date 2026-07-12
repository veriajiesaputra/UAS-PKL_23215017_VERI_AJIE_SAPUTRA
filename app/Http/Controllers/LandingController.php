<?php

namespace App\Http\Controllers;

use App\Support\LandingCache;
use Illuminate\Contracts\View\View;

class LandingController extends Controller
{
    public function home(): View
    {
        $stats = LandingCache::stats();

        return view('landing.home', compact('stats'));
    }

    public function tentang(): View
    {
        $stats = LandingCache::stats();

        return view('landing.tentang', compact('stats'));
    }

    public function caraKerja(): View
    {
        return view('landing.cara-kerja');
    }
}
