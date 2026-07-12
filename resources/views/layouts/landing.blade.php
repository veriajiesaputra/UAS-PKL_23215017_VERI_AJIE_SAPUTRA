<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Beranda') | SIPATAN</title>

    <x-favicon />
    <link rel="manifest" href="{{ asset('assets/site.webmanifest') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/tabler-icons/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/brand-logos.css') }}">
    <link rel="preload" as="image" href="{{ asset('assets/images/landing/bg-bawang.png') }}" type="image/png">

    @stack('head')
    @stack('styles')
</head>

<body class="landing-body">
    <nav class="landing-nav navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <x-brand-logos size="md" />
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#landingNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="landingNav">
                <ul class="navbar-nav mx-auto gap-lg-1">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="ti ti-home me-1"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('tentang') ? 'active' : '' }}" href="{{ route('tentang') }}">
                            <i class="ti ti-info-circle me-1"></i> Tentang
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('cara-kerja') ? 'active' : '' }}" href="{{ route('cara-kerja') }}">
                            <i class="ti ti-route me-1"></i> Cara Kerja
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('deteksi*') ? 'active' : '' }}" href="{{ route('deteksi') }}">
                            <i class="ti ti-stethoscope me-1"></i> Deteksi
                        </a>
                    </li>
                    @auth
                        @if(auth()->user()->isPengguna())
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('riwayat') ? 'active' : '' }}" href="{{ route('riwayat') }}">
                                    <i class="ti ti-history me-1"></i> Riwayat
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>

                <div class="d-flex align-items-center gap-2">
                    @auth
                        @if(auth()->user()->isStaff())
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-success btn-sm rounded-pill px-3">
                                <i class="ti ti-layout-dashboard me-1"></i> Dashboard
                            </a>
                        @else
                            <span class="badge bg-success-subtle text-success d-none d-md-inline-flex align-items-center">
                                <i class="ti ti-user me-1"></i>{{ auth()->user()->name }}
                            </span>
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-success btn-sm rounded-pill px-3">
                                    <i class="ti ti-logout me-1"></i> Keluar
                                </button>
                            </form>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-success btn-sm rounded-pill px-3">
                            <i class="ti ti-login me-1"></i> Masuk
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-success btn-sm rounded-pill px-3">
                            <i class="ti ti-user-plus me-1"></i> Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        @if (session('error'))
            <div class="container pt-5 mt-4">
                <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                    <i class="ti ti-alert-circle me-1"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif
        @if (session('success'))
            <div class="container pt-5 mt-4">
                <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                    <i class="ti ti-circle-check me-1"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif
        @yield('content')
    </main>

    <footer class="landing-footer">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-4">
                    <x-brand-logos size="sm" light class="mb-2" />
                    <p class="text-white-50 small mb-0">Sistem Pakar Diagnosa Penyakit & Hama Bawang Merah berbasis Certainty Factor.</p>
                </div>
                <div class="col-lg-4 text-lg-center">
                    <div class="footer-links">
                        <a href="{{ route('home') }}"><i class="ti ti-home me-1"></i> Beranda</a>
                        <a href="{{ route('deteksi') }}"><i class="ti ti-stethoscope me-1"></i> Deteksi</a>
                        <a href="{{ route('tentang') }}"><i class="ti ti-info-circle me-1"></i> Tentang</a>
                    </div>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <p class="text-white-50 small mb-0">&copy; {{ date('Y') }} SIPATAN. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/landing.js') }}" type="module"></script>
    @stack('scripts')
</body>

</html>
