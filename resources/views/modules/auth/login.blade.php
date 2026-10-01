@extends('layouts.auth')
@section('title','Login Administrator')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="card overflow-hidden">
            <div class="bg-primary-subtle">
                <div class="row">
                    <div class="col-7">
                        <div class="text-primary p-4">
                            <h5 class="text-primary">Selamat Datang !</h5>
                            <p>Login backoffice</p>
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
                    @include('templates.notification')
                    <form class="form-horizontal" id="form-login" method="post" action="{{ route('auth.login.submit') }}">
                        @csrf
                        <div class="mb-3 fv-row">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" autocomplete="off" required>
                        </div>
                        <div class="mb-3 fv-row">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group auth-pass-inputgroup">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon" autocomplete="off" required>
                                <button class="btn btn-light" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <x-turnstile::widget />
                        </div>
                        <div class="mt-3 d-grid">
                            <button class="btn btn-primary waves-effect waves-light" id="button-login" type="button">Log In</button>
                        </div>

                        <div class="mt-4 text-center">
                            <a href="#" class="text-muted"><i class="mdi mdi-lock me-1"></i> Lupa Password Anda?</a>
                        </div>
                    </form>
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
@section('custom-script')
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
            let form = document.getElementById('form-login');
            let buttonLogin = document.getElementById('button-login');

            buttonLogin.addEventListener('click', (event) => {
                event.preventDefault();
                validator.validate().then(function (status) {
                    console.log('Validation status:', status);
                    if (status === 'Valid') {
                        buttonLogin.disabled = true;
                        Swal.fire({
                            text: "Mohon menunggu, kami sedang memproses pengecekan data pengguna",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(() => {
                            form.submit(); // Submit form after user clicks OK
                        });
                    }
                });
            });

            let validator = FormValidation.formValidation(
                form,
                {
                    fields: {
                        'username': {
                            validators: {
                                notEmpty: {
                                    message: 'Username harus diisi'
                                }
                            }
                        },
                        'password': {
                            validators: {
                                notEmpty: {
                                    message: 'Password harus diisi'
                                }
                            }
                        }
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger({
                            event: 'input blur'
                        }),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: '.fv-row',
                            eleInvalidClass: 'is-invalid',
                            eleValidClass: 'is-valid'
                        })
                    }
                }
            );
        });
    </script>
@endsection