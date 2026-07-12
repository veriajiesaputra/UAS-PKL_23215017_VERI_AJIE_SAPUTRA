<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GejalaRequest;
use App\Models\Gejala;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GejalaController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));

        $gejala = Gejala::query()
            ->with([
                'rules.penyakit',
                'rules.hama',
            ])
            ->withCount('rules')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('kode_gejala', 'like', "%{$search}%")
                        ->orWhere('nama_gejala', 'like', "%{$search}%");
                });
            });

        $gejala = $gejala
            ->orderBy('kode_gejala')
            ->paginate(10)
            ->withQueryString();

        return view('admin.gejala.index', compact('gejala', 'search'));
    }

    public function create(): View
    {
        return view('admin.gejala.create');
    }

    public function store(GejalaRequest $request): RedirectResponse
    {
        Gejala::create($request->validated());

        return redirect()
            ->route('gejala.index')
            ->with('success', 'Gejala berhasil ditambahkan.');
    }

    public function edit(Gejala $gejala): View
    {
        $gejala->load(['rules.penyakit', 'rules.hama']);

        return view('admin.gejala.edit', [
            'gejala' => $gejala,
        ]);
    }

    public function update(GejalaRequest $request, Gejala $gejala): RedirectResponse
    {
        $gejala->update($request->validated());

        return redirect()
            ->route('gejala.index')
            ->with('success', 'Gejala berhasil diperbarui.');
    }

    public function destroy(Gejala $gejala): RedirectResponse
    {
        $gejala->delete();

        return redirect()
            ->route('gejala.index')
            ->with('success', 'Gejala berhasil dihapus.');
    }
}
