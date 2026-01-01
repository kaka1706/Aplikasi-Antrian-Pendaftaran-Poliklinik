<!-- ======= Sidebar ======= -->
@auth
@if(auth()->check())
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

        <li class="nav-heading">Management</li>

        <!-- ================= ADMIN PRODI ONLY ================= -->
        @if(auth()->user()->role === 'admin_prodi')
        <li class="nav-item">
            <a class="nav-link {{ Request::is('clinics*') ? '' : 'collapsed' }}"
               href="{{ route('clinics.index') }}">
                <i class="bi bi-hospital"></i>
                <span>Manajemen Klinik</span>
                <span class="badge bg-primary ms-auto">Admin</span>
            </a>
        </li>
        @endif

        <!-- ================= ADMIN POLI (Klinik) ONLY ================= -->
        @if(auth()->user()->role === 'admin_poli')
        
        <!-- Manajemen Poli (di klinik ini) -->
        <li class="nav-item">
            <a class="nav-link {{ Request::is('polis*') ? '' : 'collapsed' }}"
               href="{{ route('polis.index') }}">
                <i class="bi bi-building"></i>
                <span>Poli di Klinik Saya</span>
                @if(auth()->user()->clinic)
                    <small class="text-info ms-auto">{{ auth()->user()->clinic->name }}</small>
                @endif
            </a>
        </li>

        <!-- Jadwal Poli -->
        <li class="nav-item">
            <a class="nav-link {{ Request::is('poli-schedules*') ? '' : 'collapsed' }}"
               data-bs-toggle="collapse"
               href="#menu-jadwal"
               role="button"
               aria-expanded="{{ Request::is('poli-schedules*') ? 'true' : 'false' }}"
               aria-controls="menu-jadwal">
                <i class="bi bi-calendar-week"></i>
                <span>Manajemen Jadwal</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>

            <ul id="menu-jadwal"
                class="nav-content collapse {{ Request::is('poli-schedules*') ? 'show' : '' }}">

                <!-- Daftar Jadwal -->
                <li>
                    <a href="{{ auth()->check() ? route('poli_schedules.index') : '#' }}"
                       class="{{ Request::is('poli-schedules') && !Request::is('poli-schedules/*') ? 'active' : '' }}">
                        <i class="bi bi-list-ul"></i>
                        <span>Daftar Jadwal</span>
                    </a>
                </li>

                <!-- Buat Jadwal Baru -->
                <li>
                    <a href="{{ auth()->check() ? route('poli-schedules.create') : '#' }}"
                       class="{{ Request::is('poli-schedules/create') ? 'active' : '' }}">
                        <i class="bi bi-plus-circle"></i>
                        <span>Buat Jadwal Baru</span>
                    </a>
                </li>

            </ul>
        </li>

        <!-- Antrian -->
        <li class="nav-item">
            <a class="nav-link {{ Request::is('queues*') || Request::is('schedules/today') ? '' : 'collapsed' }}"
               data-bs-toggle="collapse"
               href="#menu-antrian"
               role="button"
               aria-expanded="{{ Request::is('queues*') || Request::is('schedules/today') ? 'true' : 'false' }}"
               aria-controls="menu-antrian">
                <i class="bi bi-list-check"></i>
                <span>Manajemen Antrian</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>

            <ul id="menu-antrian"
                class="nav-content collapse {{ Request::is('queues*') || Request::is('schedules/today') ? 'show' : '' }}">

                <!-- Antrian Hari Ini -->
                <li>
                    <a href="{{ auth()->check() ? route('poli_schedules.today') : '#' }}"
                       class="{{ Request::is('schedules/today') ? 'active' : '' }}">
                        <i class="bi bi-clock-history"></i>
                        <span>Antrian Hari Ini</span>
                        <span class="badge bg-warning ms-auto">Live</span>
                    </a>
                </li>

                <!-- Monitor Antrian -->
                <li>
                    <a href="{{ auth()->check() ? route('queues.index') : '#' }}"
                       class="{{ Request::is('queues*') ? 'active' : '' }}">
                        <i class="bi bi-tv"></i>
                        <span>Monitor Antrian</span>
                    </a>
                </li>

            </ul>
        </li>
        @endif

        <!-- ================= MONITORING (UNTUK SEMUA) ================= -->
        @if(auth()->check())
        <li class="nav-item">
            <a class="nav-link collapsed"
               data-bs-toggle="collapse"
               href="#menu-monitoring"
               role="button">
                <i class="bi bi-eye"></i>
                <span>Monitoring</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="menu-monitoring" class="nav-content collapse">
                
                <!-- Admin Prodi: Lihat Semua -->
                @if(auth()->user()->role === 'admin_prodi')
                <li>
                    <a href="{{ auth()->check() ? route('poli_schedules.index') : '#' }}">
                        <i class="bi bi-calendar-check"></i>
                        <span>Semua Jadwal</span>
                        <small class="text-info ms-auto">All Klinik</small>
                    </a>
                </li>
                <li>
                    <a href="{{ auth()->check() ? route('queues.index') : '#' }}">
                        <i class="bi bi-list-task"></i>
                        <span>Semua Antrian</span>
                        <small class="text-info ms-auto">View Only</small>
                    </a>
                </li>
                @endif
                
                <!-- Statistik -->
                <li>
                    <a href="#">
                        <i class="bi bi-graph-up"></i>
                        <span>Statistik</span>
                    </a>
                </li>
                
            </ul>
        </li>
        @endif

        <!-- ================= LAPORAN (HANYA ADMIN PRODI) ================= -->
        @if(auth()->check() && auth()->user()->role === 'admin_prodi')
        <li class="nav-item">
            <a class="nav-link collapsed" href="#">
                <i class="bi bi-file-earmark-text"></i>
                <span>Laporan</span>
            </a>
        </li>
        @endif

        <!-- ================= INTEGRASI SERVICE LAIN ================= -->
        @if(auth()->check())
        <li class="nav-heading">Integrasi Service</li>
        
        <li class="nav-item">
            <a class="nav-link collapsed"
               data-bs-toggle="collapse"
               href="#menu-integrasi"
               role="button">
                <i class="bi bi-shuffle"></i>
                <span>Service Lain</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="menu-integrasi" class="nav-content collapse">
                <li>
                    <a href="http://localhost:8001/docs" target="_blank">
                        <i class="bi bi-person-check"></i>
                        <span>Service Auth (Kel 1)</span>
                        <span class="badge bg-info ms-auto">API</span>
                    </a>
                </li>
                <li>
                    <a href="http://localhost:8003/docs" target="_blank">
                        <i class="bi bi-journal-text"></i>
                        <span>Logbook (Kel 3)</span>
                        <span class="badge bg-info ms-auto">API</span>
                    </a>
                </li>
                <li>
                    <a href="http://localhost:8004/docs" target="_blank">
                        <i class="bi bi-book"></i>
                        <span>Edukasi (Kel 4)</span>
                        <span class="badge bg-info ms-auto">API</span>
                    </a>
                </li>
                <li>
                    <a href="http://localhost:8005/docs" target="_blank">
                        <i class="bi bi-bell"></i>
                        <span>Notifikasi (Kel 5)</span>
                        <span class="badge bg-info ms-auto">API</span>
                    </a>
                </li>
            </ul>
        </li>
        @endif

        <!-- ================= API DOCS ================= -->
        @if(auth()->check())
        <li class="nav-item">
            <a class="nav-link {{ Request::is('api/docs') ? '' : 'collapsed' }}"
               href="{{ route('l5-swagger.default.api') }}" target="_blank">
                <i class="bi bi-code-slash"></i>
                <span>API Documentation</span>
                <span class="badge bg-success ms-auto">Swagger</span>
            </a>
        </li>
        @endif

    </ul>
</aside>
@endif
@endauth

<style>
    .sidebar {
        position: fixed;
        top: 60px;
        left: 0;
        bottom: 0;
        width: 280px;
        padding: 22px 18px;
        background: linear-gradient(180deg, #133E87 0%, #0F2F67 100%);
        border-right: 1px solid rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(6px);
        box-shadow: 4px 0 18px rgba(0, 0, 0, 0.15);
        overflow-y: auto;
        transition: 0.3s ease;
        z-index: 999;
    }

    .sidebar-nav {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .sidebar-nav .nav-heading {
        padding: 16px 0 8px 12px;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.55);
        margin-top: 15px;
    }

    .sidebar-nav .nav-item:first-child .nav-heading {
        margin-top: 0;
    }

    .sidebar-nav .nav-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 14px;
        margin-bottom: 8px;
        font-size: 15px;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.82);
        background: transparent;
        border-radius: 12px;
        transition: 0.25s ease;
        text-decoration: none;
    }

    .sidebar-nav .nav-link i {
        font-size: 18px;
        color: rgba(255, 255, 255, 0.85);
        transition: 0.25s;
        min-width: 24px;
        text-align: center;
    }

    .sidebar-nav .nav-link.collapsed {
        opacity: 0.75;
    }

    .sidebar-nav .nav-link:hover {
        background: rgba(255, 255, 255, 0.12);
        color: #fff;
        transform: translateX(4px);
    }

    .sidebar-nav .nav-link:hover i {
        color: #fff;
    }

    .sidebar-nav .nav-link:not(.collapsed) {
        background: #608BC1;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        color: #fff;
        opacity: 1;
    }

    .sidebar-nav .nav-link:not(.collapsed) i {
        color: white;
    }

    /* Submenu */
    .nav-content {
        padding-left: 40px;
        margin-top: 5px;
        list-style: none;
    }

    .nav-content li {
        margin-bottom: 5px;
    }

    .nav-content a {
        display: flex;
        align-items: center;
        padding: 8px 12px;
        font-size: 14px;
        color: rgba(255, 255, 255, 0.75);
        border-radius: 8px;
        transition: 0.2s;
        text-decoration: none;
    }

    .nav-content a:hover,
    .nav-content a.active {
        background: rgba(255, 255, 255, 0.15);
        color: #fff;
    }

    .nav-content a i {
        font-size: 14px;
        margin-right: 10px;
        min-width: 20px;
    }

    /* Role Badge */
    .sidebar-nav .badge {
        font-size: 0.65rem;
        padding: 3px 8px;
        font-weight: 500;
    }

    /* Scrollbar Styling */
    .sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.05);
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 3px;
    }

    .sidebar::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    /* Responsive */
    @media (max-width: 1199px) {
        .sidebar {
            left: -280px;
        }
    }

    .toggle-sidebar .sidebar {
        left: 0;
    }
</style>