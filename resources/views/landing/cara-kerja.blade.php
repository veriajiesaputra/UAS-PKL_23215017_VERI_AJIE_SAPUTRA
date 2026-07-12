@extends('layouts.landing')

@section('title', 'Cara Kerja')

@section('content')
    <section class="about-hero lp-photo-soft">
        <div class="container text-center">
            <span class="section-tag animate-on-scroll"><i class="ti ti-book me-1"></i> Panduan</span>
            <h1 class="section-title animate-on-scroll"><i class="ti ti-route me-2 text-success"></i>Cara Kerja SIPATAN</h1>
            <p class="text-muted mx-auto animate-on-scroll" style="max-width:640px">
                Panduan singkat menggunakan Sistem Pakar Diagnosa Penyakit &amp; Hama Bawang Merah — berbasis backward chaining dan Certainty Factor.
            </p>
        </div>
    </section>

    <section class="pb-5">
        <div class="container">
            <div class="text-center mb-4">
                <span class="section-tag"><i class="ti ti-list-numbers me-1"></i> Langkah-langkah</span>
                <h2 class="section-title h4 fw-bold">Alur Deteksi SIPATAN</h2>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-3">
                    <div class="step-card animate-on-scroll h-100">
                        <div class="step-icon"><i class="ti ti-click"></i></div>
                        <div class="step-number">1</div>
                        <h5 class="fw-bold mb-2"><i class="ti ti-bug me-1 text-success"></i>Pilih Penyakit/Hama</h5>
                        <p class="text-muted small mb-0">Pilih target diagnosa yang Anda curigai — ditampilkan dalam kartu beserta foto, kode, dan deskripsi singkat.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="step-card animate-on-scroll h-100">
                        <div class="step-icon"><i class="ti ti-list-check"></i></div>
                        <div class="step-number">2</div>
                        <h5 class="fw-bold mb-2"><i class="ti ti-leaf me-1 text-success"></i>Centang Gejala</h5>
                        <p class="text-muted small mb-0">Sistem menampilkan gejala-gejala yang terkait dengan penyakit/hama target. Centang gejala yang Anda amati pada tanaman.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="step-card animate-on-scroll h-100">
                        <div class="step-icon"><i class="ti ti-adjustments"></i></div>
                        <div class="step-number">3</div>
                        <h5 class="fw-bold mb-2"><i class="ti ti-mood-smile me-1 text-success"></i>Atur Keyakinan</h5>
                        <p class="text-muted small mb-0">Untuk setiap gejala, pilih tingkat keyakinan: Tidak (0), Tidak Yakin (0,2), Kurang Yakin (0,4), Cukup Yakin (0,6), Yakin (0,8), atau Sangat Yakin (1).</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="step-card animate-on-scroll h-100">
                        <div class="step-icon"><i class="ti ti-report-analytics"></i></div>
                        <div class="step-number">4</div>
                        <h5 class="fw-bold mb-2"><i class="ti ti-check me-1 text-success"></i>Lihat Hasil CF</h5>
                        <p class="text-muted small mb-0">Dapatkan persentase Certainty Factor, konfirmasi diagnosa, rekomendasi solusi pengendalian, dan opsi simpan riwayat.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 order-lg-2 animate-on-scroll">
                    <div class="flow-image-wrap shadow-lg rounded-4 overflow-hidden border border-light-subtle bg-white p-1">
                        <img src="{{ asset('assets/images/landing/deteksi-flow.png') }}" alt="Alur Inferensi Backward Chaining" class="img-fluid rounded-3">
                    </div>
                    <p class="text-muted small text-center mt-3 mb-0">Alur inferensi Backward Chaining pada aplikasi SIPATAN — dari hipotesis penyakit, verifikasi gejala, hingga hasil Certainty Factor</p>
                </div>
                <div class="col-lg-6 order-lg-1 animate-on-scroll">
                    <span class="section-tag"><i class="ti ti-arrows-shuffle me-1"></i> Backward Chaining</span>
                    <h2 class="section-title"><i class="ti ti-brain me-2 text-success"></i>Alur Backward Chaining</h2>
                    <p class="text-muted">
                        SIPATAN menggunakan <strong>backward chaining</strong> — mulai dari hipotesis penyakit/hama,
                        lalu verifikasi dengan gejala yang diamati pengguna:
                    </p>
                    <ul class="list-unstyled">
                        <li class="d-flex gap-3 mb-3">
                            <span class="list-icon"><i class="ti ti-target"></i></span>
                            <div>
                                <strong>Inisiasi Hipotesis (Goal Selection)</strong> — Pengguna memilih penyakit atau hama yang dicurigai sebagai <em>hipotesis awal (goal)</em> yang ingin dibuktikan kebenarannya.
                            </div>
                        </li>
                        <li class="d-flex gap-3 mb-3">
                            <span class="list-icon"><i class="ti ti-arrow-back-up"></i></span>
                            <div>
                                <strong>Pelacakan Mundur (Backtracking)</strong> — Sistem melacak mundur dari hipotesis ke basis pengetahuan untuk mengambil daftar <em>gejala (premis)</em> yang dikaitkan dengan penyakit/hama tersebut.
                            </div>
                        </li>
                        <li class="d-flex gap-3 mb-3">
                            <span class="list-icon"><i class="ti ti-clipboard-check"></i></span>
                            <div>
                                <strong>Pengumpulan Bukti (Evidence)</strong> — Pengguna mengonfirmasi gejala nyata di lapangan dengan memilih tingkat keyakinan (skala 0 hingga 1) untuk setiap gejala yang ditanyakan.
                            </div>
                        </li>
                        <li class="d-flex gap-3 mb-3">
                            <span class="list-icon"><i class="ti ti-calculator"></i></span>
                            <div>
                                <strong>Evaluasi Kepastian (Inference)</strong> — Aturan dievaluasi dengan Certainty Factor: CF<sub>gejala</sub> = CF<sub>pakar</sub> × CF<sub>user</sub>, lalu digabung secara akumulatif untuk mengukur tingkat kebenaran hipotesis tersebut.
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5" style="background: #F0FDF4;">
        <div class="container">
            <div class="text-center mb-5">
                <span class="section-tag"><i class="ti ti-users me-1"></i> Login vs Tamu</span>
                <h2 class="section-title"><i class="ti ti-login me-2 text-success"></i>Dua Mode Akses</h2>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-5">
                    <div class="about-card animate-on-scroll">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="feature-icon mb-0"><i class="ti ti-user"></i></div>
                            <h5 class="fw-bold mb-0">Dengan Login (Pengguna)</h5>
                        </div>
                        <p class="text-muted small mb-0">Daftar akun pengguna untuk menyimpan riwayat diagnosa bawang merah pribadi. Riwayat deteksi tersimpan dan dapat dilihat di menu Riwayat.</p>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="about-card animate-on-scroll">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="feature-icon mb-0"><i class="ti ti-users"></i></div>
                            <h5 class="fw-bold mb-0">Tanpa Login (Tamu)</h5>
                        </div>
                        <p class="text-muted small mb-0">Deteksi tetap bisa dilakukan tanpa akun. Riwayat disimpan sebagai tamu dan tetap masuk ke grafik dashboard admin DPKP Brebes.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section pb-5">
        <div class="container">
            <div class="cta-box text-center animate-on-scroll">
                <h3 class="fw-bold mb-3"><i class="ti ti-rocket me-2"></i>Sudah Paham? Yuk Coba SIPATAN!</h3>
                <p class="mb-4 opacity-75 mx-auto" style="max-width:480px">Diagnosa penyakit &amp; hama bawang merah — gratis, dengan atau tanpa akun.</p>
                <a href="{{ route('deteksi') }}" class="btn btn-light btn-lg rounded-pill px-5 fw-semibold">
                    <i class="ti ti-arrow-right me-2"></i>Mulai Deteksi
                </a>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) entry.target.classList.add('visible');
                });
            }, { threshold: 0.15 });
            document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));
        });
    </script>
@endpush
