@extends('template_backend.layout')

@section('title', 'Data Gejala')

@section('content')
    <x-page-header
        title="Data Gejala"
        subtitle="Kelola gejala — satu gejala dapat dipakai beberapa penyakit/hama dengan bobot CF berbeda"
        :breadcrumbs="['Dashboard' => route('dashboard'), 'Gejala' => '#']">
        <x-slot:actions>
            <a href="{{ route('gejala.create') }}" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i> Tambah Gejala
            </a>
        </x-slot:actions>
    </x-page-header>

    <div class="card">
        <div class="card-header bg-white px-4 py-3">
            <form method="GET" action="{{ route('gejala.index') }}" class="row g-2 align-items-center">
                <div class="col-md-4 col-12">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="ti ti-search"></i></span>
                        <input type="text" name="search" value="{{ $search }}"
                            class="form-control" placeholder="Cari kode atau nama gejala...">
                    </div>
                </div>
                <div class="col-md-auto col-12 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Cari</button>
                    @if ($search !== '')
                        <a href="{{ route('gejala.index') }}" class="btn btn-light">Reset</a>
                    @endif
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4" style="width: 70px;">#</th>
                        <th style="width: 160px;">Kode</th>
                        <th>Nama Gejala</th>
                        <th style="min-width: 220px;">Digunakan pada (bobot CF)</th>
                        <th class="text-end pe-4" style="width: 200px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($gejala as $item)
                        <tr>
                            <td class="ps-4">{{ $loop->iteration + ($gejala->currentPage() - 1) * $gejala->perPage() }}</td>
                            <td><span class="badge bg-primary-subtle text-primary">{{ $item->kode_gejala }}</span></td>
                            <td>{{ $item->nama_gejala }}</td>
                            <td>
                                @forelse ($item->rules as $rule)
                                    @php
                                        $target = $rule->jenis === 'penyakit' ? $rule->penyakit : $rule->hama;
                                        $label = $target
                                            ? ($rule->jenis === 'penyakit' ? $target->nama_penyakit : $target->nama_hama)
                                            : '—';
                                    @endphp
                                    <span class="badge bg-light text-dark border me-1 mb-1" title="Bobot CF pakar">
                                        {{ $label }}
                                        <strong class="text-primary">{{ number_format((float) $rule->pivot->nilai_cf, 2) }}</strong>
                                    </span>
                                @empty
                                    <span class="text-muted small">Belum dipakai di rule</span>
                                @endforelse
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-inline-flex table-action-group">
                                    <x-action-btn type="edit" :href="route('gejala.edit', $item)" />
                                    <x-action-btn type="delete" :form-action="route('gejala.destroy', $item)"
                                        :confirm="'Yakin menghapus gejala ' . $item->kode_gejala . '?'" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">
                                <i class="ti ti-database-off fs-1 d-block mb-2"></i>
                                Belum ada data gejala.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($gejala->hasPages())
            <div class="card-footer bg-white px-4 py-3">
                {{ $gejala->links() }}
            </div>
        @endif
    </div>
@endsection
