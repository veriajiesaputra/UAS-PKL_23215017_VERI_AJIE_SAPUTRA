<?php

namespace App\Http\Controllers;

use App\Models\RiwayatDeteksi;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index(Request $request): View
    {
        $riwayat = RiwayatDeteksi::query()
            ->where('user_id', $request->user()->id)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('landing.riwayat', compact('riwayat'));
    }
}
