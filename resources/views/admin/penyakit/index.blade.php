@extends('template_backend.layout')

@section('title', 'Data Penyakit')

@section('content')
    <x-page-header
        title="Data Penyakit"
        subtitle="Kelola data penyakit bawang merah"
        :breadcrumbs="['Dashboard' => route('dashboard'), 'Penyakit' => '#']">
        <x-slot:actions>
            <a href="{{ route('penyakit.create') }}" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i> Tambah Penyakit
            </a>
        </x-slot:actions>
    </x-page-header>

    <div class="card">
        <div class="card-header bg-white px-4 py-3">
            <form method="GET" action="{{ route('penyakit.index') }}" class="row g-2 align-items-center">
                <div class="col-md-4 col-12">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="ti ti-search"></i></span>
                        <input type="text" name="search" value="{{ $search }}"
                            class="form-control" placeholder="Cari kode atau nama penyakit...">
                    </div>
                </div>
                <div class="col-md-auto col-12 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Cari</button>
                    @if ($search !== '')
                        <a href="{{ route('penyakit.index') }}" class="btn btn-light">Reset</a>
                    @endif
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4" style="width: 70px;">#</th>
                        <th style="width: 80px;">Gambar</th>
                        <th style="width: 120px;">Kode</th>
                        <th>Nama Penyakit</th>
                        <th>Deskripsi</th>
                        <th class="text-end pe-4" style="width: 200px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($penyakit as $item)
                        <tr>
                            <td class="ps-4">{{ $loop->iteration + ($penyakit->currentPage() - 1) * $penyakit->perPage() }}</td>
                            <td>
                                <img src="{{ $item->gambar_url }}" alt="{{ $item->nama_penyakit }}"
                                    class="rounded border object-fit-cover"
                                    width="56" height="56"
                                    style="object-fit: cover;">
                            </td>
                            <td><span class="badge bg-danger-subtle text-danger">{{ $item->kode_penyakit }}</span></td>
                            <td class="fw-semibold">{{ $item->nama_penyakit }}</td>
                            <td class="text-muted small">{{ \Illuminate\Support\Str::limit($item->deskripsi, 80) }}</td>
                            <td class="text-end pe-4">
                                <div class="d-inline-flex table-action-group">
                                    <x-action-btn type="view" :href="route('penyakit.show', $item)" />
                                    <x-action-btn type="edit" :href="route('penyakit.edit', $item)" />
                                    <x-action-btn type="delete" :form-action="route('penyakit.destroy', $item)"
                                        :confirm="'Yakin menghapus penyakit ' . $item->kode_penyakit . '?'" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">
                                <i class="ti ti-database-off fs-1 d-block mb-2"></i>
                                Belum ada data penyakit.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($penyakit->hasPages())
            <div class="card-footer bg-white px-4 py-3">
                {{ $penyakit->links() }}
            </div>
        @endif
    </div>
@endsection
