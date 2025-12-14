<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>InPol | @yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@300;400;500;600;700&family=Raleway:wght@300;400;600;700&display=swap"
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
            color: #444;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* ==============================
            FIXED SIDEBAR ALWAYS VISIBLE
        ===============================*/

        .sidebar {
            width: 300px;
            position: fixed;
            top: 60px;
            left: 0 !important;
            height: calc(100vh - 60px);
            z-index: 9997;
            transition: none !important;
        }

        .dashboard {
            padding-top: 60px;
            padding-left: 300px !important;
            transition: none !important;
            min-height: calc(100vh - 60px);
        }

        /* NONAKTIFKAN toggle-sidebar sepenuhnya */
        body.toggle-sidebar .sidebar {
            left: 0 !important;
        }

        body.toggle-sidebar .dashboard {
            padding-left: 300px !important;
        }

        /* Hapus overlay abu-abu */
        .dashboard::after {
            content: none !important;
        }

        .pagetitle h1 {
            font-size: 24px;
            color: #012970;
            font-weight: 600;
        }

        .dashboard .card {
            border: none;
            margin-bottom: 30px;
            border-radius: 6px;
            box-shadow: 0 0 30px rgba(1, 41, 112, 0.1);
        }
    </style>

    @stack('css')
</head>

<body>

    {{-- TOPBAR --}}
    @include('layouts.topbar')

    {{-- SIDEBAR --}}
    @include('layouts.sidebar')

    {{-- MAIN CONTENT --}}
    <main id="main" class="dashboard">
        <div class="container-fluid py-4 px-4">

            {{-- PAGE TITLE --}}
            <div class="pagetitle">
                <h1>@yield('title')</h1>
                <nav>
                    <ol class="breadcrumb">
                        @yield('breadcrumb')
                    </ol>
                </nav>
            </div>

            {{-- PAGE CONTENT --}}
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
