@extends('layouts.auth')
@section('title','Lupa Password')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card overflow-hidden">
                <div class="bg-primary-subtle">
                    <div class="row">
                        <div class="col-7">
                            <div class="text-primary p-4">
                                <h5 class="text-primary">Link Reset Password Berhasil Dikirim</h5>
                            </div>
                        </div>
                        <div class="col-5 align-self-end">
                            <img src="{{ asset('images/branding-2.png') }}" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="auth-logo">
                        <a href="{{ route('landing') }}" class="auth-logo-light">
                            <div class="avatar-md profile-user-wid mb-4">
                            <span class="avatar-title rounded-circle bg-light">
                                <img src="{{ asset('images/logo.png') }}" alt="" class="rounded-circle" height="34">
                            </span>
                            </div>
                        </a>
                    </div>
                    <div class="p-2">
                        <div class="mt-3 d-grid">
                            <p>Link reset password telah dikirimkan, mohon cek pada inbox atau spam. Terima kasih</p>
                            <a href="{{ route('auth.login') }}">
                                <button class="btn btn-primary waves-effect waves-light" id="button-login" type="button">Kembali ke Halaman Login</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 text-center">
                <div>
                    <p>© <script>document.write(new Date().getFullYear())</script> E-Bebas. Crafted with <i class="mdi mdi-heart text-danger"></i> by Kelompok 1</p>
                </div>
            </div>
        </div>
    </div>
@endsection