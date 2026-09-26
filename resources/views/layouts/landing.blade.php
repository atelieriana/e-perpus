<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>E-Perpustakaan | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="E-Perpustakaan" name="description" />
    <meta content="Kelompok 1 Capstone Project UT" name="author" />
    <link rel="shortcut icon" href="{{ asset('build/resources/images/favicon.ico') }}">
    @vite('resources/scss/bootstrap.scss')
    @vite('resources/scss/icons.scss')
    @vite('resources/scss/app.scss')
    <style>
        p {
            margin-top: 0 !important;
            margin-bottom: 0 !important;
        }
    </style>
</head>

<body data-topbar="light" data-bs-theme="dark" data-layout="horizontal">
<!-- Begin page -->
<div id="layout-wrapper">
    <header id="page-topbar">
        <div class="navbar-header">
            <div class="d-flex">
                <div class="navbar-brand-box">
                    <a href="index.html" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{ asset('images/branding-2.png') }}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('images/branding-2.png') }}" alt="" height="44">
                        </span>
                    </a>
                    <a href="index.html" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ asset('images/branding-2.png') }}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('images/branding-2.png') }}" alt="" height="44">
                        </span>
                    </a>
                </div>
                <div class="d-none d-lg-block ms-2">
                    <a href="#">
                        <button type="button" class="btn header-item waves-effect" aria-haspopup="false" aria-expanded="false">
                            <span key="t-megamenu">Beranda</span>
                        </button>
                    </a>
                </div>
                <div class="d-none d-lg-block ms-2">
                    <a href="#">
                        <button type="button" class="btn header-item waves-effect" aria-haspopup="false" aria-expanded="false">
                            <span key="t-megamenu">Katalog Buku</span>
                        </button>
                    </a>
                </div>
                <div class="d-none d-lg-block ms-2">
                    <a href="#">
                        <button type="button" class="btn header-item waves-effect" aria-haspopup="false" aria-expanded="false">
                            <span key="t-megamenu">Cek Peminjaman</span>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>document.write(new Date().getFullYear())</script> © E-Perpus Kelompok 1 UT.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Design & Develop by Kelompok 1 UT
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="{{ asset('build/resources/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('build/resources/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('build/resources/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('build/resources/js/app.js') }}"></script>
</body>
</html>
