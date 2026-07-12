@extends('template_backend.layout')

@section('title', 'Tambah Gejala')

@section('content')
    <x-page-header
        title="Tambah Gejala"
        subtitle="Tambah data gejala baru"
        :breadcrumbs="[
            'Dashboard' => route('dashboard'),
            'Gejala' => route('gejala.index'),
            'Tambah' => '#',
        ]" />

    <div class="card">
        <div class="card-body p-4">
            <form action="{{ route('gejala.store') }}" method="POST">
                @csrf
                @include('admin.gejala._form')

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('gejala.index') }}" class="btn btn-light">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-device-floppy me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
