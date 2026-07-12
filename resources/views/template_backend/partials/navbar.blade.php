<nav id="topbar" class="navbar bg-white border-bottom fixed-top topbar px-3">
    <button id="toggleBtn" type="button"
        class="d-none d-lg-inline-flex btn btn-light btn-icon btn-sm"
        title="Sembunyikan sidebar" aria-label="Sembunyikan sidebar">
        <i class="fa-solid fa-bars-staggered sidebar-toggle-icon" aria-hidden="true"></i>
    </button>

    <button id="mobileBtn" type="button"
        class="btn btn-light btn-icon btn-sm d-lg-none me-2"
        title="Buka menu" aria-label="Buka menu">
        <i class="fa-solid fa-bars sidebar-toggle-icon" aria-hidden="true"></i>
    </button>

    <div>
        <ul class="list-unstyled d-flex align-items-center mb-0 gap-1">
            <li class="ms-3 dropdown">
                <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                    class="d-flex align-items-center gap-2 text-decoration-none">
                    <span class="avatar avatar-sm rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center fw-semibold">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                    </span>
                    <div class="d-none d-md-block text-start">
                        <p class="mb-0 small fw-semibold text-dark">{{ auth()->user()->name }}</p>
                        <small class="text-muted text-capitalize">{{ auth()->user()->role }}</small>
                    </div>
                    <i class="ti ti-chevron-down text-muted"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end p-0" style="min-width: 220px;">
                    <div class="d-flex gap-3 align-items-center border-bottom px-3 py-3">
                        <span class="avatar avatar-md rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center fw-semibold">
                            {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                        </span>
                        <div>
                            <h4 class="mb-0 small">{{ auth()->user()->name }}</h4>
                            <p class="mb-0 small text-muted">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    <div class="p-2 d-flex flex-column gap-1 small">
                        <a href="{{ route('profile.edit') }}" class="dropdown-item rounded">
                            <i class="ti ti-user-circle me-2"></i> Profil Saya
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item rounded text-danger">
                                <i class="ti ti-logout me-2"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
