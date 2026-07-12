@extends('template_backend.layout')

@section('title', 'Edit Hama')

@section('content')
    <x-page-header
        title="Edit Hama"
        subtitle="Perbarui data {{ $hama->nama_hama }}"
        :breadcrumbs="[
            'Dashboard' => route('dashboard'),
            'Hama' => route('hama.index'),
            'Edit' => '#',
        ]" />

    <div class="card">
        <div class="card-body p-4">
            <form action="{{ route('hama.update', $hama) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.hama._form', ['hama' => $hama])

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('hama.index') }}" class="btn btn-light">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-device-floppy me-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
