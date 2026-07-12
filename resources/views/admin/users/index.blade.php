@extends('template_backend.layout')

@section('title', 'Manajemen User')

@section('content')
    <x-page-header
        title="Manajemen User"
        subtitle="Kelola akun admin, petugas, dan pengguna"
        :breadcrumbs="['Dashboard' => route('dashboard'), 'User' => '#']">
        <x-slot:actions>
            <a href="{{ route('users.create') }}" class="btn btn-primary">
                <i class="ti ti-user-plus me-1"></i> Tambah User
            </a>
        </x-slot:actions>
    </x-page-header>

    <div class="card">
        <div class="card-header bg-white px-4 py-3">
            <form method="GET" action="{{ route('users.index') }}" class="row g-2 align-items-center">
                <div class="col-md-4 col-12">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="ti ti-search"></i></span>
                        <input type="text" name="search" value="{{ $search }}"
                            class="form-control" placeholder="Cari nama atau email...">
                    </div>
                </div>
                <div class="col-md-auto col-12 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Cari</button>
                    @if ($search !== '')
                        <a href="{{ route('users.index') }}" class="btn btn-light">Reset</a>
                    @endif
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4" style="width: 70px;">#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th style="width: 140px;">Role</th>
                        <th class="text-end pe-4" style="width: 160px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td class="ps-4">{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="avatar avatar-sm rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center fw-semibold">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </span>
                                    <span class="fw-semibold">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="text-muted">{{ $user->email }}</td>
                            <td>
                                @php
                                    $roleColors = [
                                        'admin' => 'primary',
                                        'petugas' => 'secondary',
                                        'pengguna' => 'success',
                                    ];
                                    $color = $roleColors[$user->role] ?? 'secondary';
                                @endphp
                                <span class="badge bg-{{ $color }}-subtle text-{{ $color }} text-capitalize">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-inline-flex table-action-group">
                                    <x-action-btn type="edit" :href="route('users.edit', $user)" />
                                    @if ($user->id !== auth()->id())
                                        <x-action-btn type="delete" :form-action="route('users.destroy', $user)"
                                            :confirm="'Yakin menghapus user ' . $user->name . '?'" />
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">
                                <i class="ti ti-users-off fs-1 d-block mb-2"></i>
                                Belum ada user.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($users->hasPages())
            <div class="card-footer bg-white px-4 py-3">
                {{ $users->links() }}
            </div>
        @endif
    </div>
@endsection
