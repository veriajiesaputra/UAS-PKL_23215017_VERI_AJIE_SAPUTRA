<x-guest-layout>
    @section('title', 'Register')

    <h1 class="h4 fw-semibold mb-1">Daftar akun</h1>
    <p class="text-muted small mb-4">Buat akun pengguna untuk melakukan deteksi dan melihat riwayat diagnosa.</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}"
                class="form-control @error('name') is-invalid @enderror"
                required autofocus autocomplete="name">
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                class="form-control @error('email') is-invalid @enderror"
                required autocomplete="username">
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" name="password"
                class="form-control @error('password') is-invalid @enderror"
                required autocomplete="new-password">
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                class="form-control" required autocomplete="new-password">
        </div>

        <button type="submit" class="btn btn-primary w-100 mb-3">
            <i class="ti ti-user-plus me-1"></i> Daftar
        </button>

        <div class="text-center small">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-decoration-none">Login di sini</a>
        </div>
    </form>
</x-guest-layout>
