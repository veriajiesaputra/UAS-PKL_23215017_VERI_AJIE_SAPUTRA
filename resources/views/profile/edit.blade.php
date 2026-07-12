@extends('template_backend.layout')

@section('title', 'Profil Saya')

@section('content')
    <x-page-header
        title="Profil Saya"
        subtitle="Perbarui informasi akun dan password Anda"
        :breadcrumbs="['Dashboard' => route('dashboard'), 'Profil' => '#']" />

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header bg-white px-4 py-3">
                    <h5 class="mb-0">Informasi Profil</h5>
                </div>
                <div class="card-body p-4">
                    @if (session('status') === 'profile-updated')
                        <div class="alert alert-success small">Profil berhasil diperbarui.</div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name"
                                value="{{ old('name', $user->name) }}"
                                class="form-control @error('name', 'updateProfileInformation') is-invalid @enderror"
                                required>
                            @error('name', 'updateProfileInformation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email"
                                value="{{ old('email', $user->email) }}"
                                class="form-control @error('email', 'updateProfileInformation') is-invalid @enderror"
                                required>
                            @error('email', 'updateProfileInformation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-device-floppy me-1"></i> Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header bg-white px-4 py-3">
                    <h5 class="mb-0">Ubah Password</h5>
                </div>
                <div class="card-body p-4">
                    @if (session('status') === 'password-updated')
                        <div class="alert alert-success small">Password berhasil diperbarui.</div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Password Saat Ini</label>
                            <input type="password" name="current_password"
                                class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                                autocomplete="current-password">
                            @error('current_password', 'updatePassword') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <input type="password" name="password"
                                class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                                autocomplete="new-password">
                            @error('password', 'updatePassword') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation"
                                class="form-control" autocomplete="new-password">
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-lock me-1"></i> Update Password
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card border-danger">
                <div class="card-header bg-white px-4 py-3">
                    <h5 class="mb-0 text-danger"><i class="ti ti-alert-triangle me-2"></i>Hapus Akun</h5>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted small">
                        Setelah akun dihapus, seluruh data dan sesi terkait akan ikut terhapus secara permanen.
                        Pastikan Anda telah mengunduh data yang ingin disimpan.
                    </p>

                    <form method="POST" action="{{ route('profile.destroy') }}"
                        onsubmit="return confirm('Yakin ingin menghapus akun Anda secara permanen?');">
                        @csrf
                        @method('DELETE')

                        <div class="mb-3" style="max-width: 320px;">
                            <label class="form-label">Konfirmasi dengan password</label>
                            <input type="password" name="password"
                                class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                                required>
                            @error('password', 'userDeletion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <button type="submit" class="btn btn-danger">
                            <i class="ti ti-trash me-1"></i> Hapus Akun
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
