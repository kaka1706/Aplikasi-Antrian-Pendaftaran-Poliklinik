<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>InPol  | @yield('title')</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ URL::asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ URL::asset('assets/css/main.css') }}" rel="stylesheet">


    <style>
        :root {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--default-font);
            background: #f6f9ff;
            color: #444444;
            position: relative;
            min-height: 100vh;
        }

        .dashboard {
            padding-top: 60px;
            transition: all 0.3s ease;
            min-height: calc(100vh - 60px);
            overflow-x: hidden;
        }

        @media (min-width: 1200px) {
            body:not(.toggle-sidebar) .dashboard {
                padding-left: 300px;
            }

            body.toggle-sidebar .dashboard {
                padding-left: 0;
            }

            body.toggle-sidebar .sidebar {
                left: -300px;
            }
        }

        @media (max-width: 1199px) {
            .dashboard {
                padding-left: 0;
            }

            .sidebar {
                left: -300px;
            }

            body.toggle-sidebar .sidebar {
                left: 0;
            }

            body.toggle-sidebar .dashboard {
                padding-left: 0;
                position: relative;
            }

            body.toggle-sidebar .dashboard::after {
                content: "";
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.4);
                z-index: 999;
            }
        }

        .pagetitle {
            margin-bottom: 10px;
        }

        .pagetitle h1 {
            font-size: 24px;
            margin-bottom: 0;
            font-weight: 600;
            color: #012970;
        }

        .dashboard .card {
            margin-bottom: 30px;
            border: none;
            border-radius: 5px;
            box-shadow: 0px 0 30px rgba(1, 41, 112, 0.1);
        }

        .dashboard .card-header {
            border-color: #ebeef4;
            background-color: #fff;
            color: #798eb3;
            padding: 15px;
        }

        .dashboard .card-title {
            padding: 20px 0 15px 0;
            font-size: 18px;
            font-weight: 500;
            color: #012970;
            font-family: "Poppins", sans-serif;
            margin: 0;
        }

        .dashboard .card-title span {
            color: #899bbd;
            font-size: 14px;
            font-weight: 400;
        }

        .dashboard .card-body {
            padding: 0 20px 20px 20px;
        }

        /* Content Spacing */
        .container-fluid {
            max-width: 1600px;
            margin: 0 auto;
            width: 100%;
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            .container-fluid {
                padding: 15px !important;
            }
        }

        .breadcrumb {
            font-size: 14px;
            font-family: "Nunito", sans-serif;
            color: #899bbd;
            font-weight: 600;
        }

        .breadcrumb a {
            color: #899bbd;
            transition: 0.3s;
        }

        .breadcrumb a:hover {
            color: #51678f;
        }

        .breadcrumb .breadcrumb-item::before {
            color: #899bbd;
        }

        .breadcrumb .active {
            color: #51678f;
            font-weight: 600;
        }

        /* Sidebar Toggle State */
        body.toggle-sidebar .sidebar {
            transition: all 0.3s ease;
        }
    </style>

    @stack('css')
</head>

<body>
    {{-- Header --}}
    @include('layouts.topbar')

    {{-- Sidebar --}}
    {{-- @include('layouts.sidebar') --}}
    <aside class="w-64 bg-white shadow-lg p-4">
        <h2 class="text-xl font-bold mb-4">Menu</h2>

        @if(Auth::user()->role === 'admin_prodi')
            <a href="/dashboard/prodi" class="block py-2">Dashboard Prodi</a>
            <a href="/clinics" class="block py-2">Kelola Klinik</a>
        @endif

        @if(Auth::user()->role === 'admin_poli')
            <a href="/dashboard/poli" class="block py-2">Dashboard Poli</a>
            <a href="/polis" class="block py-2">Kelola Poli</a>
            <a href="/antrian" class="block py-2">Kelola Antrian</a>
        @endif
    </aside>

    {{-- Main Content --}}
    <main id="main" class="dashboard">
        <div class="container-fluid py-4 px-4">
            {{-- Page Title --}}
            <div class="pagetitle">
                <h1>@yield('title')</h1>
                <nav>
                    <ol class="breadcrumb">
                        @yield('breadcrumb')
                    </ol>
                </nav>
            </div>

            {{-- Content --}}
            @yield('content')
        </div>
    </main>

    {{-- Scroll Top --}}
    <a href="#" class="scroll-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    {{-- Preloader --}}
    <div id="preloader"></div>

    {{-- Vendor JS Files --}}
    <script src="{{ URL::asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    {{-- Main JS File --}}
    <script src="{{ URL::asset('assets/js/main.js') }}"></script>

    @stack('js')
</body>

</html>