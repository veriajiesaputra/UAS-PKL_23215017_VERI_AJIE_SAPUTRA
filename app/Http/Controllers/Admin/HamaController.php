<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HamaRequest;
use App\Models\Hama;
use App\Support\TargetImageUploader;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HamaController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));

        $hama = Hama::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('kode_hama', 'like', "%{$search}%")
                        ->orWhere('nama_hama', 'like', "%{$search}%");
                });
            });

        $hama = $hama
            ->orderBy('kode_hama')
            ->paginate(10)
            ->withQueryString();

        return view('admin.hama.index', compact('hama', 'search'));
    }

    public function create(): View
    {
        return view('admin.hama.create');
    }

    public function store(HamaRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = TargetImageUploader::store($request->file('gambar'), 'hama');
        }

        Hama::create($data);

        return redirect()
            ->route('hama.index')
            ->with('success', 'Hama berhasil ditambahkan.');
    }

    public function show(Hama $hama): View
    {
        return view('admin.hama.show', [
            'hama' => $hama,
        ]);
    }

    public function edit(Hama $hama): View
    {
        return view('admin.hama.edit', [
            'hama' => $hama,
        ]);
    }

    public function update(HamaRequest $request, Hama $hama): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            TargetImageUploader::delete($hama->gambar);
            $data['gambar'] = TargetImageUploader::store($request->file('gambar'), 'hama');
        }

        $hama->update($data);

        return redirect()
            ->route('hama.index')
            ->with('success', 'Hama berhasil diperbarui.');
    }

    public function destroy(Hama $hama): RedirectResponse
    {
        $hama->delete();

        return redirect()
            ->route('hama.index')
            ->with('success', 'Hama berhasil dihapus.');
    }
}
