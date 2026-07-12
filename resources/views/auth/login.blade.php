<x-guest-layout>
    @section('title', 'Login')

    @if (session('status'))
        <div class="alert alert-success small">{{ session('status') }}</div>
    @endif

    <h1 class="h4 fw-semibold mb-1">Selamat datang kembali</h1>
    <p class="text-muted small mb-4">Masuk untuk mengelola data sistem pakar.</p>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email"
                value="{{ old('email') }}"
                class="form-control @error('email') is-invalid @enderror"
                required autofocus autocomplete="username">
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <x-password-input id="password" name="password" label="Password" autocomplete="current-password" />

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="form-check">
                <input id="remember_me" type="checkbox" name="remember" class="form-check-input">
                <label class="form-check-label small" for="remember_me">Ingat saya</label>
            </div>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="small text-decoration-none">Lupa password?</a>
            @endif
        </div>

        <button type="submit" class="btn btn-primary w-100">
            <i class="ti ti-login me-1"></i> Login
        </button>
    </form>

    <div class="text-center mt-4">
        <a href="{{ route('home') }}" class="small text-decoration-none">
            <i class="ti ti-arrow-left me-1"></i> Kembali ke Beranda
        </a>
    </div>
</x-guest-layout>
