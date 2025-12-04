<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center">
            <!-- <img src="{{ URL::asset('assets/img/sirefislogo.png') }}" alt="Logo"> -->
            <span class="d-none d-lg-block" style="color: #133E87;">InPol</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                    <!-- <img src="{{ Auth::user()->image }}" alt="Profile" class="rounded-circle"> -->
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ Auth::user()->name }}</h6>
                        <span>{{ Auth::user()->email }}</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>


                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Keluar</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
    transition: all 0.5s;
    z-index: 997;
    height: 60px;
    box-shadow: 0px 2px 20px rgba(1, 41, 112, 0.1);
    background-color: #ffffffff;
    padding-left: 20px;
}

.header .toggle-sidebar-btn {
    font-size: 32px;
    padding-left: 10px;
    cursor: pointer;
    color: #012970;
}

.header .search-bar {
    min-width: 360px;
    padding: 0 20px;
}

@media (max-width: 1199px) {
    .header .search-bar {
        position: fixed;
        top: 50px;
        left: 0;
        right: 0;
        padding: 20px;
        box-shadow: 0px 0px 15px 0px rgba(1, 41, 112, 0.1);
        background: white;
        z-index: 9999;
        transition: 0.3s;
        visibility: hidden;
        opacity: 0;
    }

    .header .search-bar-show {
        top: 60px;
        visibility: visible;
        opacity: 1;
    }
}

.header .search-form {
    width: 100%;
}

.header .search-form input {
    border: 0;
    font-size: 14px;
    color: #012970;
    border: 1px solid rgba(1, 41, 112, 0.2);
    padding: 7px 38px 7px 8px;
    border-radius: 3px;
    transition: 0.3s;
    width: 100%;
}

.header .search-form input:focus,
.header .search-form input:hover {
    outline: none;
    box-shadow: 0 0 10px 0 rgba(1, 41, 112, 0.15);
    border: 1px solid rgba(1, 41, 112, 0.3);
}

.header .search-form button {
    border: 0;
    padding: 0;
    margin-left: -30px;
    background: none;
}

.header .search-form button i {
    color: #012970;
}

.header .logo {
    line-height: 1;
}

@media (min-width: 1200px) {
    .header .logo {
        width: 280px;
    }
}

.header .logo img {
    max-height: 36px;
    margin-right: 6px;
}

.header .logo span {
    font-size: 26px;
    font-weight: 700;
    color: #012970;
    font-family: "Nunito", sans-serif;
}

.header-nav ul {
    list-style: none;
}

.header-nav>ul {
    margin: 0;
    padding: 0;
}

.header-nav .nav-icon {
    font-size: 22px;
    color: #012970;
    margin-right: 25px;
    position: relative;
}

.header-nav .nav-profile {
    color: #012970;
    padding: 5px 10px;
    border-radius: 4px;
    transition: 0.3s;
}

.header-nav .nav-profile:hover {
    background: rgba(1, 41, 112, 0.1);
}

.header-nav .nav-profile img {
    max-height: 36px;
    margin-right: 8px;
    border: 2px solid #e4e6ef;
}

.header-nav .nav-profile span {
    font-size: 14px;
    font-weight: 600;
}

.header-nav .badge-number {
    position: absolute;
    inset: -2px -5px auto auto;
    font-weight: normal;
    font-size: 12px;
    padding: 3px 6px;
}

.header-nav .notifications {
    inset: 8px -15px auto auto !important;
}

.header-nav .notifications .notification-item {
    display: flex;
    align-items: center;
    padding: 15px 10px;
    transition: 0.3s;
}

.header-nav .notifications .notification-item i {
    margin: 0 20px 0 10px;
    font-size: 24px;
}

.header-nav .notifications .notification-item h4 {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 5px;
}

.header-nav .notifications .notification-item p {
    font-size: 13px;
    margin-bottom: 3px;
    color: #919191;
}

.header-nav .notifications .notification-item:hover {
    background-color: #f6f9ff;
}

.header-nav .profile {
    min-width: 240px;
    padding-bottom: 0;
    top: 8px !important;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    border: none;
    border-radius: 0.475rem;
}

.header-nav .profile .dropdown-header {
    padding: 20px;
    border-bottom: 1px solid #ebeef4;
}

.header-nav .profile .dropdown-header h6 {
    font-size: 18px;
    margin-bottom: 5px;
    font-weight: 600;
    color: #012970;
}

.header-nav .profile .dropdown-header span {
    font-size: 14px;
    color: #899bbd;
}

.header-nav .profile .dropdown-item {
    font-size: 14px;
    padding: 12px 20px;
    transition: 0.3s;
    display: flex;
    align-items: center;
    border-radius: 4px;
    margin: 4px;
}

.header-nav .profile .dropdown-item i {
    margin-right: 10px;
    font-size: 18px;
    color: #012970;
}

.header-nav .profile .dropdown-item span {
    color: #012970;
}

.header-nav .profile .dropdown-item:hover {
    background-color: rgba(1, 41, 112, 0.1);
}

.header-nav .profile .dropdown-divider {
    margin: 0;
    border-top: 1px solid #ebeef4;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle sidebar function
    const toggleSidebarBtn = document.querySelector('.toggle-sidebar-btn');
    const body = document.querySelector('body');

    if (toggleSidebarBtn) {
        toggleSidebarBtn.addEventListener('click', function(e) {
            body.classList.toggle('toggle-sidebar');
        });
    }
});
</script>
