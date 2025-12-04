<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard') ? '' : 'collapsed' }}" href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-heading">App</li>

        <li class="nav-item">
            <a class="nav-link {{ Request::is('clinics*') ? '' : 'collapsed' }}" href="{{ route('clinics.index') }}">
                <i class="bi bi-hospital"></i>
                <span>Klinik</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Request::is('polis*') ? '' : 'collapsed' }}" href="{{ route('polis.index') }}">
                <i class="bi bi-building"></i>
                <span>Poli</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Request::is('queues*') ? '' : 'collapsed' }}" href="{{ route('queues.index') }}">
                <i class="bi bi-list-check"></i>
                <span>Antrian</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Request::is('history*') ? '' : 'collapsed' }}" href="{{ route('history.index') }}">
                <i class="bi bi-clock-history"></i>
                <span>Riwayat</span>
            </a>
        </li>
    </ul>
</aside>


<style>
    /* Side*/

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
        transition: 0.3s ease;
        z-index: 999;
    }

    /* Scrollbar premium */
    .sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.25);
        border-radius: 12px;
    }

    .sidebar-nav {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    /* Section Header */
    .sidebar-nav .nav-heading {
        padding: 16px 0 8px 12px;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.55);
    }

    /* Menu style */
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
    }

    /* Icons */
    .sidebar-nav .nav-link i {
        font-size: 18px;
        color: rgba(255, 255, 255, 0.85);
        transition: 0.25s;
    }

    /* Collapsed = inactive menu */
    .sidebar-nav .nav-link.collapsed {
        opacity: 0.75;
    }

    /* Hover */
    .sidebar-nav .nav-link:hover {
        background: rgba(255, 255, 255, 0.12);
        color: #fff;
        transform: translateX(4px);
    }

    .sidebar-nav .nav-link:hover i {
        color: #fff;
    }

    /* Active Menu */
    .sidebar-nav .nav-link:not(.collapsed) {
        background: #608BC1;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        color: #fff;
        opacity: 1;
        transform: translateX(0);
    }

    .sidebar-nav .nav-link:not(.collapsed) i {
        color: white;
    }

    /* Responsive */
    @media (max-width: 1199px) {
        .sidebar {
            left: -260px;
        }
    }

    .toggle-sidebar .sidebar {
        left: 0;
    }
</style>