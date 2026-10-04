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
                                <h5 class="text-primary">Lupa Password?</h5>
                                <p>Masukkan Email Anda</p>
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
                        <form class="form-horizontal" id="form-reset-password" method="post" action="{{ route('auth.reset.password.submit') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $dataToken->token }}"/>
                            <input type="hidden" name="id-user" value="{{ $dataToken->ref_user->uuid }}"/>
                            <div class="mb-3 fv-row">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group auth-pass-inputgroup">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password baru" aria-label="Password" aria-describedby="password-addon" autocomplete="off" required>
                                    <button class="btn btn-light" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                </div>
                            </div>
                            <div class="mb-3 fv-row">
                                <label class="form-label" for="ulang-password">Ulang Password</label>
                                <div class="input-group auth-pass-inputgroup">
                                    <input type="password" class="form-control" id="ulang-password" name="ulang-password" placeholder="Ulang password baru anda" aria-label="Ulang Password" aria-describedby="password-addon-1" autocomplete="off" required>
                                    <button class="btn btn-light" type="button" id="password-addon-1"><i class="mdi mdi-eye-outline"></i></button>
                                </div>
                            </div>
                            <div class="mb-3">
                                <x-turnstile::widget />
                            </div>
                            <div class="mt-3 d-grid">
                                <button class="btn btn-primary waves-effect waves-light" id="button-reset-password" type="button">Reset Password</button>
                            </div>

                            <div class="mt-4 text-center">
                                <a href="{{ route('auth.login') }}" class="text-muted"><i class="mdi mdi-login me-1"></i> Kembali ke Halaman Login</a>
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
            let form = document.getElementById('form-reset-password');
            let buttonLogin = document.getElementById('button-reset-password');

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

            console.log(form.querySelector('[name="ulang-password"]').value)

            let validator = FormValidation.formValidation(
                form,
                {
                    fields: {
                        'password': {
                            validators: {
                                notEmpty: {
                                    message: 'Password wajib diisi'
                                },
                                regexp: {
                                    regexp: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/,
                                    message: 'Password minimal 8 karakter, memiliki huruf besar, huruf kecil, dan spesial karakter'
                                }
                            }
                        },
                        'ulang-password': {
                            validators: {
                                notEmpty: {
                                    message: 'Ulangi password wajib diisi'
                                },
                                identical: {
                                    compare: function () {
                                        return form.querySelector('[name="password"]').value
                                    },
                                    message: 'Password tidak sama'
                                }
                            }
                        },
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