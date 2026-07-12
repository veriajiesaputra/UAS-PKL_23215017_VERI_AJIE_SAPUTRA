@extends('template_backend.layout')

@section('title', 'Tambah Hama')

@section('content')
    <x-page-header
        title="Tambah Hama"
        subtitle="Tambah data hama padi"
        :breadcrumbs="[
            'Dashboard' => route('dashboard'),
            'Hama' => route('hama.index'),
            'Tambah' => '#',
        ]" />

    <div class="card">
        <div class="card-body p-4">
            <form action="{{ route('hama.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('admin.hama._form')

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('hama.index') }}" class="btn btn-light">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-device-floppy me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
