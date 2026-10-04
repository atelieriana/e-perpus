<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>E-Perpustakaan | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="E-Perpustakaan" name="description" />
    <meta content="Kelompok 1 Capstone Project UT" name="author" />
    <link rel="shortcut icon" href="{{ asset('icon/favicon.ico') }}">
    @vite('resources/scss/bootstrap.scss')
    @vite('resources/scss/icons.scss')
    @vite('resources/scss/app.scss')
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
            </div>
        </div>
    </header>
    @livewire('topnav')

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
@vite('resources/js/extension.js')
@vite('resources/libs/bootstrap/js/bootstrap.bundle.min.js')
@vite('resources/js/app.js')
@yield('custom-script')
</body>
</html>
