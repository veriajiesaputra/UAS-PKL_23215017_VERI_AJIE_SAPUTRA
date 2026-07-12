@extends('template_backend.layout')

@section('title', 'Tambah Penyakit')

@section('content')
    <x-page-header
        title="Tambah Penyakit"
        subtitle="Tambah data penyakit padi"
        :breadcrumbs="[
            'Dashboard' => route('dashboard'),
            'Penyakit' => route('penyakit.index'),
            'Tambah' => '#',
        ]" />

    <div class="card">
        <div class="card-body p-4">
            <form action="{{ route('penyakit.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('admin.penyakit._form')

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('penyakit.index') }}" class="btn btn-light">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-device-floppy me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
