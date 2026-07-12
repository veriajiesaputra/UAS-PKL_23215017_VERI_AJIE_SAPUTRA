<x-guest-layout>
    @section('title', 'Verifikasi Email')

    <p class="text-muted small mb-4">
        Terima kasih telah mendaftar! Sebelum memulai, mohon verifikasi alamat email Anda
        dengan mengklik tautan yang baru saja kami kirim.
        Belum menerima email? Klik tombol di bawah untuk meminta tautan baru.
    </p>

    @if (session('status') === 'verification-link-sent')
        <div class="alert alert-success small">Tautan verifikasi baru telah dikirim ke email Anda.</div>
    @endif

    <div class="d-flex justify-content-between align-items-center">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary">
                <i class="ti ti-send me-1"></i> Kirim ulang email
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-link text-decoration-none small">Logout</button>
        </form>
    </div>
</x-guest-layout>
