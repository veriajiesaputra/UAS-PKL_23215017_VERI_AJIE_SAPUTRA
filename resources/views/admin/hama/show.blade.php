@extends('template_backend.layout')

@section('title', 'Detail Hama')

@section('content')
    <x-page-header
        :title="$hama->nama_hama"
        :subtitle="$hama->kode_hama"
        :breadcrumbs="[
            'Dashboard' => route('dashboard'),
            'Hama' => route('hama.index'),
            'Detail' => '#',
        ]">
        <x-slot:actions>
            <a href="{{ route('hama.edit', $hama) }}" class="btn btn-primary">
                <i class="ti ti-edit me-1"></i> Edit
            </a>
            <a href="{{ route('hama.index') }}" class="btn btn-light">Kembali</a>
        </x-slot:actions>
    </x-page-header>

    <div class="row g-3">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body p-4">
                    <h5 class="mb-3"><i class="ti ti-info-circle me-2 text-primary"></i>Deskripsi</h5>
                    <p class="mb-0 text-muted">{{ $hama->deskripsi ?: 'Belum ada deskripsi.' }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body p-4">
                    <h5 class="mb-3"><i class="ti ti-medical-cross me-2 text-success"></i>Solusi</h5>
                    <p class="mb-0 text-muted">{{ $hama->solusi ?: 'Belum ada solusi.' }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
