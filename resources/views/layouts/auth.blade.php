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
    <link rel="stylesheet" src="{{ asset('build/resources/plugins/sweetalert2/sweetalert2.min.css') }}" type="text/css">
    <x-turnstile::script />
</head>

<body data-topbar="light" data-bs-theme="dark" data-layout="horizontal">
<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        @yield('content')
    </div>
</div>
<script src="{{ asset('build/js/jquery/jquery.min.js') }}"></script>
@vite('resources/js/extension.js')
@vite('resources/libs/bootstrap/js/bootstrap.bundle.min.js')
@vite('resources/js/app.js')
@yield('custom-script')
</body>
</html>
