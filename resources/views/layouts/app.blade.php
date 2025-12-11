<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>InPol | @yield('title')</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Poppins:wght@100;300;400;500;600;700;800;900&family=Raleway:wght@100;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ URL::asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS -->
    <link href="{{ URL::asset('assets/css/main.css') }}" rel="stylesheet">

    <style>
        :root {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--default-font);
            background: #f6f9ff;
            color: #444;
            min-height: 100vh;
            position: relative;
        }

        /* ---------- DASHBOARD ---------- */
        .dashboard {
            padding-top: 60px;
            transition: all 0.3s ease;
            min-height: calc(100vh - 60px);
        }

        @media (min-width: 1200px) {
            body:not(.toggle-sidebar) .dashboard {
                padding-left: 300px;
            }

            body.toggle-sidebar .dashboard {
                padding-left: 0;
            }
        }

        @media (max-width: 1199px) {
            .dashboard {
                padding-left: 0 !important;
            }

            .sidebar {
                left: -300px;
            }

            body.toggle-sidebar .sidebar {
                left: 0;
            }

            /* FIX: overlay tidak menghalangi klik */
            body.toggle-sidebar .dashboard::after {
                content: "";
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.4);
                pointer-events: none;
                z-index: 10;
            }
        }

        /* ---------- SIDEBAR FIX ---------- */
        .sidebar {
            z-index: 1000 !important;
            position: fixed;
        }

        /* ---------- TITLE ---------- */
        .pagetitle {
            margin-bottom: 10px;
        }

        .pagetitle h1 {
            font-size: 24px;
            font-weight: 600;
            color: #012970;
        }

        /* ---------- CARD ---------- */
        .dashboard .card {
            margin-bottom: 30px;
            border: none;
            border-radius: 5px;
            box-shadow: 0px 0 30px rgba(1, 41, 112, 0.1);
        }

        .dashboard .card-header {
            border-color: #ebeef4;
            background: #fff;
            color: #798eb3;
            padding: 15px;
        }

        .dashboard .card-title {
            padding: 20px 0 15px;
            font-size: 18px;
            font-weight: 500;
            color: #012970;
        }

        .breadcrumb {
            font-size: 14px;
            color: #899bbd;
            font-weight: 600;
        }

        .breadcrumb a {
            color: #899bbd;
        }

        .breadcrumb a:hover {
            color: #51678f;
        }

        .breadcrumb .active {
            color: #51678f;
            font-weight: 600;
        }
    </style>

    @stack('css')
</head>

<body>

    {{-- Header --}}
    @include('layouts.topbar')

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Main --}}
    <main id="main" class="dashboard">
        <div class="container-fluid py-4 px-4">

            <div class="pagetitle">
                <h1>@yield('title')</h1>
                <nav>
                    <ol class="breadcrumb">
                        @yield('breadcrumb')
                    </ol>
                </nav>
            </div>

            @yield('content')

        </div>
    </main>

    {{-- Scroll Top --}}
    <a href="#" class="scroll-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    {{-- Preloader --}}
    <div id="preloader"></div>

    <!-- Vendor JS -->
    <script src="{{ URL::asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ URL::asset('assets/js/main.js') }}"></script>

    @stack('js')

</body>
</html>
