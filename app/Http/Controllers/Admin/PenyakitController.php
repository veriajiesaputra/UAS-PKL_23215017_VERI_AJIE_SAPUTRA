<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PenyakitRequest;
use App\Models\Penyakit;
use App\Support\TargetImageUploader;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PenyakitController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));

        $penyakit = Penyakit::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('kode_penyakit', 'like', "%{$search}%")
                        ->orWhere('nama_penyakit', 'like', "%{$search}%");
                });
            });

        $penyakit = $penyakit
            ->orderBy('kode_penyakit')
            ->paginate(10)
            ->withQueryString();

        return view('admin.penyakit.index', compact('penyakit', 'search'));
    }

    public function create(): View
    {
        return view('admin.penyakit.create');
    }

    public function store(PenyakitRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = TargetImageUploader::store($request->file('gambar'), 'penyakit');
        }

        Penyakit::create($data);

        return redirect()
            ->route('penyakit.index')
            ->with('success', 'Penyakit berhasil ditambahkan.');
    }

    public function show(Penyakit $penyakit): View
    {
        return view('admin.penyakit.show', [
            'penyakit' => $penyakit,
        ]);
    }

    public function edit(Penyakit $penyakit): View
    {
        return view('admin.penyakit.edit', [
            'penyakit' => $penyakit,
        ]);
    }

    public function update(PenyakitRequest $request, Penyakit $penyakit): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            TargetImageUploader::delete($penyakit->gambar);
            $data['gambar'] = TargetImageUploader::store($request->file('gambar'), 'penyakit');
        }

        $penyakit->update($data);

        return redirect()
            ->route('penyakit.index')
            ->with('success', 'Penyakit berhasil diperbarui.');
    }

    public function destroy(Penyakit $penyakit): RedirectResponse
    {
        $penyakit->delete();

        return redirect()
            ->route('penyakit.index')
            ->with('success', 'Penyakit berhasil dihapus.');
    }
}
