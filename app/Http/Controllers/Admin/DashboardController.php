<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gejala;
use App\Models\Hama;
use App\Models\Penyakit;
use App\Models\RiwayatDeteksi;
use App\Models\Rule;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $stats = [
            'gejala' => Gejala::count(),
            'penyakit' => Penyakit::count(),
            'hama' => Hama::count(),
            'rules' => Rule::count(),
            'users' => User::count(),
            'deteksi' => RiwayatDeteksi::count(),
        ];

        $latestRules = Rule::latest()->take(5)->get();
        $latestGejala = Gejala::latest()->take(5)->get();
        $latestDeteksi = RiwayatDeteksi::with(['user'])
            ->latest()->take(8)->get();

        $chartData = $this->buildChartData();

        return view('admin.dashboard', compact('stats', 'latestRules', 'latestGejala', 'latestDeteksi', 'chartData'));
    }

    private function buildChartData(): array
    {
        $penyakitRules = Penyakit::query()
            ->withCount(['rules'])
            ->orderByDesc('rules_count')
            ->take(6)
            ->get(['id', 'kode_penyakit', 'nama_penyakit']);

        $hamaRules = Hama::query()
            ->withCount(['rules'])
            ->orderByDesc('rules_count')
            ->take(6)
            ->get(['id', 'kode_hama', 'nama_hama']);

        $deteksiPerBulan = RiwayatDeteksi::query()
            ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as bulan"), DB::raw('COUNT(*) as total'))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->take(12)
            ->get();

        $deteksiPenyakit = RiwayatDeteksi::query()
            ->where('jenis_hasil', 'penyakit')
            ->select('nama_target', DB::raw('COUNT(*) as total'))
            ->groupBy('nama_target')
            ->orderByDesc('total')
            ->take(6)
            ->get();

        $deteksiHama = RiwayatDeteksi::query()
            ->where('jenis_hasil', 'hama')
            ->select('nama_target', DB::raw('COUNT(*) as total'))
            ->groupBy('nama_target')
            ->orderByDesc('total')
            ->take(6)
            ->get();

        return [
            'overview' => [
                'categories' => ['Gejala', 'Penyakit', 'Hama', 'Rules'],
                'series' => [
                    Gejala::count(),
                    Penyakit::count(),
                    Hama::count(),
                    Rule::count(),
                ],
            ],
            'penyakit' => [
                'categories' => $penyakitRules->pluck('kode_penyakit')->all(),
                'labels' => $penyakitRules->pluck('nama_penyakit')->all(),
                'series' => $penyakitRules->pluck('rules_count')->map(fn ($v) => (int) $v)->all(),
            ],
            'hama' => [
                'categories' => $hamaRules->pluck('kode_hama')->all(),
                'labels' => $hamaRules->pluck('nama_hama')->all(),
                'series' => $hamaRules->pluck('rules_count')->map(fn ($v) => (int) $v)->all(),
            ],
            'deteksi_bulan' => [
                'categories' => $deteksiPerBulan->pluck('bulan')->map(fn ($b) => date('M Y', strtotime($b . '-01')))->all(),
                'series' => $deteksiPerBulan->pluck('total')->map(fn ($v) => (int) $v)->all(),
            ],
            'deteksi_penyakit' => [
                'categories' => $deteksiPenyakit->pluck('nama_target')->all(),
                'series' => $deteksiPenyakit->pluck('total')->map(fn ($v) => (int) $v)->all(),
            ],
            'deteksi_hama' => [
                'categories' => $deteksiHama->pluck('nama_target')->all(),
                'series' => $deteksiHama->pluck('total')->map(fn ($v) => (int) $v)->all(),
            ],
        ];
    }
}
