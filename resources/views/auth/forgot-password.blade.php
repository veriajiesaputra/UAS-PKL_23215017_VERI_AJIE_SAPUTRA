<x-guest-layout>
    @section('title', 'Lupa Password')

    <h1 class="h4 fw-semibold mb-1">Lupa password?</h1>
    <p class="text-muted small mb-4">
        Masukkan email Anda dan kami akan mengirim tautan untuk membuat password baru.
    </p>

    @if (session('status'))
        <div class="alert alert-success small">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                class="form-control @error('email') is-invalid @enderror"
                required autofocus>
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100 mb-3">
            <i class="ti ti-mail me-1"></i> Kirim tautan reset
        </button>

        <div class="text-center small">
            <a href="{{ route('login') }}" class="text-decoration-none">Kembali ke login</a>
        </div>
    </form>
</x-guest-layout>
