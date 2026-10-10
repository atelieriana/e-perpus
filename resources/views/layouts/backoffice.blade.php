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
    <link rel="stylesheet" type="text/css" href="{{ asset('build/css/datatables.net-bs4/dataTables.bootstrap4.min.css') }}"/>

</head>

<body data-topbar="dark" data-bs-theme="dark" data-layout="horizontal">
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
            <div class="d-flex">
                <div class="dropdown d-inline-block d-lg-none ms-2">
                    <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-magnify"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">
                        <form class="p-3">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Search input">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>s
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="dropdown d-none d-lg-inline-block ms-1">
                    <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                        <i class="bx bx-fullscreen"></i>
                    </button>
                </div>
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user" src="{{ asset('images/user-image-placeholder.png') }}" alt="Header Avatar">
                        <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{ session()->get('access-data')['nama'] }}</span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item d-block" href="#"><span class="badge bg-success float-end">11</span><i class="bx bx-wrench font-size-16 align-middle me-1"></i> <span key="t-settings">Settings</span></a>
                        <a class="dropdown-item text-danger" href="{{ route('auth.logout') }}"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                    </div>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                        <i class="bx bx-cog bx-spin"></i>
                    </button>
                </div>

            </div>
        </div>
    </header>
    @livewire('topnav')
    <div class="right-bar">
        <div data-simplebar="init" class="h-100 simplebar-scrollable-y">
            <div class="simplebar-wrapper" style="margin: 0px;">
                <div class="simplebar-height-auto-observer-wrapper">
                    <div class="simplebar-height-auto-observer"></div>
                </div>
                <div class="simplebar-mask">
                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                        <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                            <div class="simplebar-content" style="padding: 0px;">
                                <div class="rightbar-title d-flex align-items-center px-3 py-4">
                                    <h5 class="m-0 me-2">Settings</h5>
                                    <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                                        <i class="mdi mdi-close noti-icon"></i>
                                    </a>
                                </div>
                                <hr class="mt-0">
                                <h6 class="text-center mb-0">Choose Layouts</h6>

                                <div class="p-4">
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch">
                                        <label class="form-check-label" for="light-mode-switch">Light Mode</label>
                                    </div>
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch" checked="">
                                        <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="simplebar-placeholder" style="width: 280px; height: 1065px;"></div>
            </div>
            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
            </div>
            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                <div class="simplebar-scrollbar" style="height: 133px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
            </div>
        </div> <!-- end slimscroll-menu-->
    </div>

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
<script src="{{ asset('build/js/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('build/js/datatables.net/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('build/js/datatables.net-bs4/dataTables.bootstrap4.min.js') }}"></script>
@vite('resources/js/extension.js')
@vite('resources/libs/bootstrap/js/bootstrap.bundle.min.js')
@vite('resources/js/app.js')
@yield('custom-script')
</body>
</html>
