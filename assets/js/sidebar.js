const sidebar = document.getElementById('sidebar');
const content = document.getElementById('content');
const topbar = document.getElementById('topbar');
const toggleBtn = document.getElementById('toggleBtn');
const mobileBtn = document.getElementById('mobileBtn');
const overlay = document.getElementById('overlay');

function isMobileSidebarOpen() {
    return sidebar?.classList.contains('mobile-show') ?? false;
}

function closeMobileSidebar() {
    sidebar?.classList.remove('mobile-show');
    overlay?.classList.remove('show');
    updateMobileToggleIcon(false);
}

function openMobileSidebar() {
    sidebar?.classList.add('mobile-show');
    overlay?.classList.add('show');
    updateMobileToggleIcon(true);
}

function updateSidebarToggleIcon() {
    if (!toggleBtn) return;

    const icon = toggleBtn.querySelector('i');
    if (!icon) return;

    const collapsed = sidebar?.classList.contains('collapsed');
    icon.className = collapsed
        ? 'fa-solid fa-angles-right sidebar-toggle-icon'
        : 'fa-solid fa-bars-staggered sidebar-toggle-icon';
    toggleBtn.setAttribute(
        'title',
        collapsed ? 'Tampilkan sidebar' : 'Sembunyikan sidebar',
    );
    toggleBtn.setAttribute(
        'aria-label',
        collapsed ? 'Tampilkan sidebar' : 'Sembunyikan sidebar',
    );
}

function updateMobileToggleIcon(isOpen = isMobileSidebarOpen()) {
    if (!mobileBtn) return;

    const icon = mobileBtn.querySelector('i');
    if (!icon) return;

    icon.className = isOpen
        ? 'fa-solid fa-xmark sidebar-toggle-icon'
        : 'fa-solid fa-bars sidebar-toggle-icon';
    mobileBtn.setAttribute('title', isOpen ? 'Tutup menu' : 'Buka menu');
    mobileBtn.setAttribute('aria-label', isOpen ? 'Tutup menu' : 'Buka menu');
}

// Desktop collapse
if (toggleBtn) {
    updateSidebarToggleIcon();

    toggleBtn.addEventListener('click', () => {
        if (sidebar) sidebar.classList.toggle('collapsed');
        if (content) content.classList.toggle('full');
        if (topbar) topbar.classList.toggle('full');
        updateSidebarToggleIcon();
    });
}

// Mobile sidebar toggle
if (mobileBtn) {
    updateMobileToggleIcon(false);

    mobileBtn.addEventListener('click', () => {
        if (isMobileSidebarOpen()) {
            closeMobileSidebar();
            return;
        }

        openMobileSidebar();
    });
}

// Click outside to close
if (overlay) {
    overlay.addEventListener('click', closeMobileSidebar);
}

const currentPage = window.location.pathname.split('/').pop() || 'index.html';
const navLinks = document.querySelectorAll('.sidebar .nav-link');

if (navLinks.length > 0) {
    navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === currentPage) {
            link.classList.add('active');
        }

        link.addEventListener('click', () => {
            if (window.innerWidth < 992) {
                closeMobileSidebar();
            }
        });
    });
}

window.addEventListener('resize', () => {
    if (window.innerWidth >= 992 && isMobileSidebarOpen()) {
        closeMobileSidebar();
    }
});
