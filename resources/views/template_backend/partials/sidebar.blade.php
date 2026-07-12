@php
    $user = auth()->user();
@endphp

<aside id="sidebar" class="sidebar">
    <div class="logo-area">
        <a href="{{ route('dashboard') }}" class="d-inline-block text-decoration-none">
            <x-brand-logos size="sm" />
        </a>
    </div>

    <ul class="nav flex-column">
        <li class="px-4 py-2"><small class="nav-text text-uppercase text-muted">Main</small></li>
        <li>
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <i class="ti ti-home"></i><span class="nav-text">Dashboard</span>
            </a>
        </li>
        <li>
            <a class="nav-link" href="{{ route('home') }}" target="_blank">
                <i class="ti ti-world"></i><span class="nav-text">Landing Page</span>
            </a>
        </li>

        <li class="px-4 pt-4 pb-2"><small class="nav-text text-uppercase text-muted">Data Sistem Pakar</small></li>
        <li>
            <a class="nav-link {{ request()->routeIs('gejala.*') ? 'active' : '' }}" href="{{ route('gejala.index') }}">
                <i class="ti ti-stethoscope"></i><span class="nav-text">Gejala</span>
            </a>
        </li>
        <li>
            <a class="nav-link {{ request()->routeIs('penyakit.*') ? 'active' : '' }}" href="{{ route('penyakit.index') }}">
                <i class="ti ti-virus"></i><span class="nav-text">Penyakit</span>
            </a>
        </li>
        <li>
            <a class="nav-link {{ request()->routeIs('hama.*') ? 'active' : '' }}" href="{{ route('hama.index') }}">
                <i class="ti ti-bug"></i><span class="nav-text">Hama</span>
            </a>
        </li>
        <li>
            <a class="nav-link {{ request()->routeIs('rules.*') ? 'active' : '' }}" href="{{ route('rules.index') }}">
                <i class="ti ti-binary-tree"></i><span class="nav-text">Rules &amp; CF</span>
            </a>
        </li>

        @if ($user && $user->isAdmin())
            <li class="px-4 pt-4 pb-2"><small class="nav-text text-uppercase text-muted">Manajemen</small></li>
            <li>
                <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                    <i class="ti ti-users"></i><span class="nav-text">User</span>
                </a>
            </li>
        @endif

        <li class="px-4 pt-4 pb-2"><small class="nav-text text-uppercase text-muted">Akun</small></li>
        <li>
            <a class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.edit') }}">
                <i class="ti ti-user-circle"></i><span class="nav-text">Profil</span>
            </a>
        </li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link bg-transparent border-0 w-100 text-start">
                    <i class="ti ti-logout"></i><span class="nav-text">Logout</span>
                </button>
            </form>
        </li>
    </ul>
</aside>
