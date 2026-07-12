@extends('template_backend.layout')

@section('title', 'Edit Penyakit')

@section('content')
    <x-page-header
        title="Edit Penyakit"
        subtitle="Perbarui data {{ $penyakit->nama_penyakit }}"
        :breadcrumbs="[
            'Dashboard' => route('dashboard'),
            'Penyakit' => route('penyakit.index'),
            'Edit' => '#',
        ]" />

    <div class="card">
        <div class="card-body p-4">
            <form action="{{ route('penyakit.update', $penyakit) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.penyakit._form', ['penyakit' => $penyakit])

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('penyakit.index') }}" class="btn btn-light">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-device-floppy me-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
