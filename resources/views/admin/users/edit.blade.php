@extends('template_backend.layout')

@section('title', 'Edit User')

@section('content')
    <x-page-header
        title="Edit User"
        subtitle="Perbarui data {{ $user->name }}"
        :breadcrumbs="[
            'Dashboard' => route('dashboard'),
            'User' => route('users.index'),
            'Edit' => '#',
        ]" />

    <div class="card">
        <div class="card-body p-4">
            <form action="{{ route('users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.users._form', ['user' => $user, 'isUpdate' => true])

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('users.index') }}" class="btn btn-light">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-device-floppy me-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
