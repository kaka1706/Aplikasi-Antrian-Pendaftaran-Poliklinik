<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center">
            <span class="d-none d-lg-block" style="color: #133E87;">InPol</span>
        </a>

        <!-- Icon toggle dimatikan (optional) -->
        <i class="bi bi-list toggle-sidebar-btn" style="cursor: default !important; opacity: .3;"></i>
    </div>

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ Auth::user()->name }}</h6>
                        <span>{{ Auth::user()->email }}</span>
                    </li>

                    <li><hr class="dropdown-divider"></li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" 
                           href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Keluar</span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}"
                              method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</header>

<style>
.header {
    transition: all 0.3s ease;
    z-index: 998;
    height: 60px;
    background-color: #ffffff;
    padding-left: 20px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
}

.header .logo span {
    font-size: 24px;
    font-weight: 700;
    color: #133E87;
}

.header .nav-profile {
    color: #012970;
    padding: 5px 10px;
    border-radius: 4px;
}

.header-nav .profile {
    min-width: 240px;
    top: 10px !important;
    border-radius: 8px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.1);
}

.header-nav .profile .dropdown-item:hover {
    background: rgba(1, 41, 112, 0.1);
}
</style>

<script>
// Disable toggle to avoid overlay
document.addEventListener('DOMContentLoaded', function() {
    const btn = document.querySelector('.toggle-sidebar-btn');
    if (btn) btn.style.pointerEvents = "none";
});
</script>
