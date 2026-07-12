@extends('layouts.landing')

@section('title', 'Beranda')

@push('head')
    <link rel="preload" as="image" href="{{ asset('assets/images/landing/hero-bawang.jpg') }}" type="image/jpeg">
@endpush

@section('content')
    {{-- Hero Section --}}
    <section class="hero-section lp-photo-hero">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 order-lg-1">
                    <div class="hero-text">
                        <div class="hero-badge">
                            <i class="ti ti-sparkles"></i>
                            Sistem Pakar Berbasis Certainty Factor
                        </div>
                        <h1 class="hero-title">
                            Deteksi <span>Penyakit & Hama</span> Bawang Merah
                        </h1>
                        <p class="hero-desc">
                            SIPATAN membantu petani dan penyuluh pertanian mendiagnosis penyakit dan hama
                            pada bawang merah secara interaktif. Pilih gejala yang Anda amati, lalu dapatkan rekomendasi solusi berdasarkan metode Certainty Factor.
                        </p>
                        <div class="hero-buttons d-flex flex-wrap gap-3">
                            <a href="{{ route('deteksi') }}" class="btn btn-success btn-lg">
                                <i class="ti ti-stethoscope me-2"></i>Mulai Deteksi
                            </a>
                            @guest
                                <a href="{{ route('login') }}" class="btn btn-outline-success btn-lg">
                                    <i class="ti ti-login me-2"></i>Masuk Akun
                                </a>
                            @else
                                @if (auth()->user()->isStaff())
                                    <a href="{{ route('dashboard') }}" class="btn btn-outline-success btn-lg">
                                        <i class="ti ti-layout-dashboard me-2"></i>Dashboard Admin
                                    </a>
                                @else
                                    <a href="{{ route('riwayat') }}" class="btn btn-outline-success btn-lg">
                                        <i class="ti ti-history me-2"></i>Riwayat Deteksi
                                    </a>
                                @endif
                            @endguest
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-2">
                    <div class="hero-image-wrap mx-auto text-center">
                        <x-landing-picture src="assets/images/landing/hero-bawang.jpg" alt="Pertanian bawang merah Brebes" class="img-fluid hero-photo" width="800" height="533" fetchpriority="high" />
                        <div class="floating-badge top-left">
                            <div class="icon bg-success-subtle text-success"><i class="ti ti-leaf"></i></div>
                            <div>
                                <div class="fw-bold small">{{ $stats['penyakit'] }}+ Penyakit</div>
                                <div class="text-muted" style="font-size:0.75rem">Terdata</div>
                            </div>
                        </div>
                        <div class="floating-badge bottom-right">
                            <div class="icon bg-warning-subtle text-warning"><i class="ti ti-bug"></i></div>
                            <div>
                                <div class="fw-bold small">{{ $stats['hama'] }}+ Hama</div>
                                <div class="text-muted" style="font-size:0.75rem">Terdata</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats --}}
    <section class="stats-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-6 col-lg-3">
                    <div class="stat-card-lp animate-on-scroll">
                        <div class="stat-icon stat-icon-penyakit">
                            <i class="ti ti-virus" aria-hidden="true"></i>
                        </div>
                        <div class="stat-number">{{ $stats['penyakit'] }}</div>
                        <div class="stat-label">Penyakit Terdata</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="stat-card-lp animate-on-scroll">
                        <div class="stat-icon stat-icon-hama">
                            <i class="ti ti-bug" aria-hidden="true"></i>
                        </div>
                        <div class="stat-number">{{ $stats['hama'] }}</div>
                        <div class="stat-label">Hama Terdata</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="stat-card-lp animate-on-scroll">
                        <div class="stat-icon stat-icon-gejala">
                            <i class="ti ti-clipboard-list" aria-hidden="true"></i>
                        </div>
                        <div class="stat-number">{{ $stats['gejala'] }}</div>
                        <div class="stat-label">Gejala Terdaftar</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="stat-card-lp animate-on-scroll">
                        <div class="stat-icon stat-icon-deteksi">
                            <i class="ti ti-report-search" aria-hidden="true"></i>
                        </div>
                        <div class="stat-number">{{ $stats['deteksi'] }}</div>
                        <div class="stat-label">Total Deteksi</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Features --}}
    <section class="features-section">
        <div class="container">
            <div class="text-center mb-5">
                <span class="section-tag"><i class="ti ti-star me-1"></i> Keunggulan</span>
                <h2 class="section-title"><i class="ti ti-leaf me-2 text-success"></i>Mengapa SIPATAN?</h2>
                <p class="text-muted mx-auto" style="max-width:600px">Diagnosis cepat, akurat, dan mudah digunakan — baik dengan login maupun tanpa login.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-xl-3">
                    <div class="feature-card animate-on-scroll" data-bs-toggle="modal" data-bs-target="#featureModal1">
                        <div class="feature-icon"><i class="ti ti-brain"></i></div>
                        <h5 class="fw-bold">Metode Certainty Factor</h5>
                        <p class="text-muted small mb-0">Perhitungan tingkat keyakinan berdasarkan bobot gejala yang ditentukan pakar pertanian.</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="feature-card animate-on-scroll" data-bs-toggle="modal" data-bs-target="#featureModal2">
                        <div class="feature-icon"><i class="ti ti-click"></i></div>
                        <h5 class="fw-bold">Interaktif & Mudah</h5>
                        <p class="text-muted small mb-0">Pilih gejala langkah demi langkah. Sistem menyesuaikan pertanyaan berdasarkan pilihan Anda.</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="feature-card animate-on-scroll" data-bs-toggle="modal" data-bs-target="#featureModal4">
                        <div class="feature-icon"><i class="ti ti-adjustments"></i></div>
                        <h5 class="fw-bold">Atur Keyakinan</h5>
                        <p class="text-muted small mb-0">Pilih tingkat keyakinan dari 6 pilihan (Tidak hingga Sangat Yakin) untuk setiap gejala yang diamati.</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="feature-card animate-on-scroll" data-bs-toggle="modal" data-bs-target="#featureModal3">
                        <div class="feature-icon"><i class="ti ti-shield-check"></i></div>
                        <h5 class="fw-bold">Tanpa Login</h5>
                        <p class="text-muted small mb-0">Deteksi penyakit bisa dilakukan kapan saja. Login opsional untuk menyimpan riwayat pribadi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="cta-section">
        <div class="container">
            <div class="cta-box text-center animate-on-scroll">
                <h2 class="fw-bold mb-3"><i class="ti ti-plant-2 me-2"></i>Siap Mendeteksi Penyakit Bawang Merah?</h2>
                <p class="mb-4 opacity-75 mx-auto" style="max-width:500px">
                    Mulai diagnosa bawang merah sekarang — gratis, tanpa perlu mendaftar. Hasil deteksi akan tersimpan untuk analisis di dashboard admin.
                </p>
                <a href="{{ route('deteksi') }}" class="btn btn-light btn-lg rounded-pill px-4 fw-semibold">
                    <i class="ti ti-arrow-right me-2"></i>Mulai Sekarang
                </a>
            </div>
        </div>
    </section>

    {{-- Feature Modals --}}
    <div class="modal fade" id="featureModal1" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0">
                <div class="modal-body p-4 text-center">
                    <div class="feature-icon mx-auto mb-3"><i class="ti ti-brain"></i></div>
                    <h5 class="fw-bold">Certainty Factor</h5>
                    <p class="text-muted">Metode CF menggabungkan tingkat keyakinan pakar untuk setiap gejala, menghasilkan persentase diagnosa yang akurat dan transparan.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="featureModal2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0">
                <div class="modal-body p-4 text-center">
                    <x-landing-picture src="assets/images/landing/feature-deteksi.png" alt="Deteksi interaktif" class="img-fluid rounded-3 mb-3" loading="lazy" width="800" height="533" />
                    <h5 class="fw-bold">Deteksi Interaktif</h5>
                    <p class="text-muted">Gejala ditampilkan secara adaptif — mulai dari gejala utama setiap penyakit, lalu menyesuaikan berdasarkan pilihan Anda.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="featureModal4" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0">
                <div class="modal-body p-4 text-center">
                    <div class="feature-icon mx-auto mb-3"><i class="ti ti-adjustments"></i></div>
                    <h5 class="fw-bold">Tingkat Keyakinan Pengguna</h5>
                    <p class="text-muted">Setiap gejala dilengkapi tingkat keyakinan: Tidak (0), Tidak Yakin (0,2), Kurang Yakin (0,4), Cukup Yakin (0,6), Yakin (0,8), atau Sangat Yakin (1).</p>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="featureModal3" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0">
                <div class="modal-body p-4 text-center">
                    <div class="feature-icon mx-auto mb-3"><i class="ti ti-shield-check"></i></div>
                    <h5 class="fw-bold">Akses Bebas</h5>
                    <p class="text-muted">Semua pengguna — login maupun tamu — dapat melakukan deteksi. Riwayat deteksi otomatis tersimpan untuk statistik dashboard admin.</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const nav = document.querySelector('.landing-nav');
            window.addEventListener('scroll', () => {
                nav.classList.toggle('scrolled', window.scrollY > 50);
            });

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) entry.target.classList.add('visible');
                });
            }, { threshold: 0.15 });

            document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));
        });
    </script>
@endpush
