<x-guest-layout>
    @section('title', 'Konfirmasi Password')

    <p class="text-muted small mb-4">
        Ini adalah area aman. Mohon konfirmasi password Anda sebelum melanjutkan.
    </p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" name="password"
                class="form-control @error('password') is-invalid @enderror"
                required autocomplete="current-password">
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">
            <i class="ti ti-lock me-1"></i> Konfirmasi
        </button>
    </form>
</x-guest-layout>
