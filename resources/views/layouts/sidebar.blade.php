<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <!-- ================= Dashboard ================= -->
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard') ? '' : 'collapsed' }}"
               href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-heading">App</li>

        <!-- ================= Klinik (ADMIN PRODI) ================= -->
        @auth
        @if(auth()->user()->role === 'admin_prodi')
        <li class="nav-item">
            <a class="nav-link {{ Request::is('clinics*') ? '' : 'collapsed' }}"
               href="{{ route('clinics.index') }}">
                <i class="bi bi-hospital"></i>
                <span>Klinik</span>
            </a>
        </li>
        @endif
        @endauth

        <!-- ================= Poli + Jadwal ================= -->
        <li class="nav-item">
            <a class="nav-link {{ Request::is('polis*') || Request::is('poli-schedules*') ? '' : 'collapsed' }}"
               data-bs-toggle="collapse"
               href="#menu-poli"
               role="button"
               aria-expanded="{{ Request::is('polis*') || Request::is('poli-schedules*') ? 'true' : 'false' }}"
               aria-controls="menu-poli">
                <i class="bi bi-building"></i>
                <span>Poli</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>

            <ul id="menu-poli"
                class="nav-content collapse {{ Request::is('polis*') || Request::is('poli-schedules*') ? 'show' : '' }}">

                <!-- Daftar Poli -->
                <li>
                    <a href="{{ route('polis.index') }}"
                       class="{{ Request::is('polis*') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i>
                        <span>Daftar Poli</span>
                    </a>
                </li>

                <!-- Jadwal Poli -->
                <li>
                    <a href="{{ route('poli_schedules.index') }}"
                       class="{{ Request::is('poli_schedules*') ? 'active' : '' }}">
                        <i class="bi bi-calendar-week"></i>
                        <span>Jadwal Poli</span>
                    </a>
                </li>

            </ul>
        </li>

        <!-- ================= Antrian (OPSIONAL) ================= -->
        {{--
        <li class="nav-item">
            <a class="nav-link {{ Request::is('queues*') ? '' : 'collapsed' }}"
               href="{{ route('queues.index') }}">
                <i class="bi bi-list-check"></i>
                <span>Antrian</span>
            </a>
        </li>
        --}}

    </ul>
</aside>

<style>
.sidebar {
    position: fixed;
    top: 60px;
    left: 0;
    bottom: 0;
    width: 260px;
    padding: 22px 18px;
    background: linear-gradient(180deg, #133E87 0%, #0F2F67 100%);
    border-right: 1px solid rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(6px);
    box-shadow: 4px 0 18px rgba(0, 0, 0, 0.15);
    overflow-y: auto;
    z-index: 999;
}

.sidebar-nav {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar-nav .nav-heading {
    padding: 16px 0 8px 12px;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 600;
    color: rgba(255, 255, 255, 0.55);
}

.sidebar-nav .nav-link {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 14px;
    margin-bottom: 8px;
    font-size: 15px;
    font-weight: 600;
    color: rgba(255, 255, 255, 0.85);
    border-radius: 12px;
    transition: 0.25s ease;
}

.sidebar-nav .nav-link i {
    font-size: 18px;
}

.sidebar-nav .nav-link.collapsed {
    opacity: 0.75;
}

.sidebar-nav .nav-link:hover {
    background: rgba(255, 255, 255, 0.12);
    color: #fff;
}

.sidebar-nav .nav-link:not(.collapsed) {
    background: #608BC1;
    color: #fff;
}

.nav-content {
    padding-left: 30px;
}

.nav-content a {
    display: flex;
    align-items: center;
    padding: 8px 10px;
    font-size: 14px;
    color: rgba(255,255,255,0.85);
    border-radius: 8px;
}

.nav-content a.active,
.nav-content a:hover {
    background: rgba(255,255,255,0.18);
    color: #fff;
}
</style>

<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
