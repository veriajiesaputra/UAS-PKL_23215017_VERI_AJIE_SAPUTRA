@extends('template_backend.layout')

@section('title', 'Data Hama')

@section('content')
    <x-page-header
        title="Data Hama"
        subtitle="Kelola data hama bawang merah"
        :breadcrumbs="['Dashboard' => route('dashboard'), 'Hama' => '#']">
        <x-slot:actions>
            <a href="{{ route('hama.create') }}" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i> Tambah Hama
            </a>
        </x-slot:actions>
    </x-page-header>

    <div class="card">
        <div class="card-header bg-white px-4 py-3">
            <form method="GET" action="{{ route('hama.index') }}" class="row g-2 align-items-center">
                <div class="col-md-4 col-12">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="ti ti-search"></i></span>
                        <input type="text" name="search" value="{{ $search }}"
                            class="form-control" placeholder="Cari kode atau nama hama...">
                    </div>
                </div>
                <div class="col-md-auto col-12 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Cari</button>
                    @if ($search !== '')
                        <a href="{{ route('hama.index') }}" class="btn btn-light">Reset</a>
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
                        <th>Nama Hama</th>
                        <th>Deskripsi</th>
                        <th class="text-end pe-4" style="width: 200px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($hama as $item)
                        <tr>
                            <td class="ps-4">{{ $loop->iteration + ($hama->currentPage() - 1) * $hama->perPage() }}</td>
                            <td>
                                <img src="{{ $item->gambar_url }}" alt="{{ $item->nama_hama }}"
                                    class="rounded border object-fit-cover"
                                    width="56" height="56"
                                    style="object-fit: cover;">
                            </td>
                            <td><span class="badge bg-warning-subtle text-warning">{{ $item->kode_hama }}</span></td>
                            <td class="fw-semibold">{{ $item->nama_hama }}</td>
                            <td class="text-muted small">{{ \Illuminate\Support\Str::limit($item->deskripsi, 80) }}</td>
                            <td class="text-end pe-4">
                                <div class="d-inline-flex table-action-group">
                                    <x-action-btn type="view" :href="route('hama.show', $item)" />
                                    <x-action-btn type="edit" :href="route('hama.edit', $item)" />
                                    <x-action-btn type="delete" :form-action="route('hama.destroy', $item)"
                                        :confirm="'Yakin menghapus hama ' . $item->kode_hama . '?'" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">
                                <i class="ti ti-database-off fs-1 d-block mb-2"></i>
                                Belum ada data hama.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($hama->hasPages())
            <div class="card-footer bg-white px-4 py-3">
                {{ $hama->links() }}
            </div>
        @endif
    </div>
@endsection
