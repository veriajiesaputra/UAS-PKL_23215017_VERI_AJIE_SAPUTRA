@extends('template_backend.layout')

@section('title', 'Detail Penyakit')

@section('content')
    <x-page-header
        :title="$penyakit->nama_penyakit"
        :subtitle="$penyakit->kode_penyakit"
        :breadcrumbs="[
            'Dashboard' => route('dashboard'),
            'Penyakit' => route('penyakit.index'),
            'Detail' => '#',
        ]">
        <x-slot:actions>
            <a href="{{ route('penyakit.edit', $penyakit) }}" class="btn btn-primary">
                <i class="ti ti-edit me-1"></i> Edit
            </a>
            <a href="{{ route('penyakit.index') }}" class="btn btn-light">Kembali</a>
        </x-slot:actions>
    </x-page-header>

    <div class="row g-3">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body p-4">
                    <h5 class="mb-3"><i class="ti ti-info-circle me-2 text-primary"></i>Deskripsi</h5>
                    <p class="mb-0 text-muted">{{ $penyakit->deskripsi ?: 'Belum ada deskripsi.' }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body p-4">
                    <h5 class="mb-3"><i class="ti ti-medical-cross me-2 text-success"></i>Solusi</h5>
                    <p class="mb-0 text-muted">{{ $penyakit->solusi ?: 'Belum ada solusi.' }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
