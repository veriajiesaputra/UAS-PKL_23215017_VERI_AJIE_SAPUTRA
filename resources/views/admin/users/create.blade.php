@extends('template_backend.layout')

@section('title', 'Tambah User')

@section('content')
    <x-page-header
        title="Tambah User"
        subtitle="Buat akun baru untuk admin atau petugas"
        :breadcrumbs="[
            'Dashboard' => route('dashboard'),
            'User' => route('users.index'),
            'Tambah' => '#',
        ]" />

    <div class="card">
        <div class="card-body p-4">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                @include('admin.users._form')

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('users.index') }}" class="btn btn-light">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-device-floppy me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
