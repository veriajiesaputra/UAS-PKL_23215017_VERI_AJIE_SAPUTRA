<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Auth') | {{ config('app.name') }}</title>

    <x-favicon />
    <link rel="manifest" href="{{ asset('assets/site.webmanifest') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/brand-logos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/tabler-icons/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}">
</head>

<body class="bg-light">
    <div class="min-vh-100 d-flex flex-column flex-lg-row">
        <!-- Left Side: Onion Farming Photo Background -->
        <div class="d-none d-lg-flex col-lg-6 align-items-center justify-content-center position-relative text-white p-5" 
             style="background-image: linear-gradient(135deg, rgba(74, 4, 78, 0.7) 0%, rgba(136, 19, 55, 0.6) 100%), url('{{ asset('assets/images/landing/bg-bawang.png') }}'); background-size: cover; background-position: center;">
            <div class="position-relative text-center" style="max-width: 480px;">
                <h2 class="fw-bold mb-3" style="font-family: 'Outfit', sans-serif; font-size: 2.25rem;">SIPATAN Bawang Merah</h2>
                <p class="opacity-80 lead">Sistem Pakar Diagnosa Hama dan Penyakit Bawang Merah Kabupaten Brebes berbasis Certainty Factor.</p>
            </div>
        </div>
        
        <!-- Right Side: Login Form -->
        <div class="col-lg-6 d-flex align-items-center justify-content-center p-4 p-md-5">
            <div class="card border-0 shadow-sm" style="max-width: 440px; width: 100%;">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <a href="{{ url('/') }}" class="d-inline-block text-decoration-none">
                            <x-brand-logos size="lg" />
                        </a>
                        <p class="text-muted small mt-3 mb-0">Sistem Pakar Diagnosa Hama &amp; Penyakit Bawang Merah</p>
                    </div>

                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/landing.js') }}" type="module"></script>
    @stack('scripts')
</body>

</html>
