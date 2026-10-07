@extends('layouts.backoffice')
@section('title','Referensi Buku')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Referensi Buku</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('buku-pelajaran.buku.index') }}">Buku Pelajaran</a></li>
                        <li class="breadcrumb-item active">Buat</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @include('templates.notification')
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-sm-4">
                        <div class="search-box me-2 mb-2 d-inline-block">
                            <div class="position-relative">
                                <h4>Tambah Buku Pelajaran</h4>
                            </div>
                        </div>
                    </div>
                    <form id="form-buku-pelajaran" method="post" action="{{ route('buku-pelajaran.buku.create.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="fv-row row mb-4">
                            <label for="judul" class="col-sm-3 col-form-label">Judul Buku</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan judul buku">
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="kota-terbit" class="col-sm-3 col-form-label">Kota Terbit</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kota-terbit" name="kota-terbit" placeholder="Masukkan kota terbit">
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="penerbit" class="col-sm-3 col-form-label">Penerbit</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="penerbit" name="penerbit" placeholder="Masukkan penerbit">
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="penulis" class="col-sm-3 col-form-label">Penulis</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="penulis" name="penulis" placeholder="Masukkan penulis">
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="tahun-terbit" class="col-sm-3 col-form-label">Tahun Terbit</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="tahun-terbit" name="tahun-terbit" placeholder="Masukkan tahun terbit">
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="isbn" class="col-sm-3 col-form-label">ISBN</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="isbn" name="isbn" placeholder="Masukkan ISBN">
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="deskripsi-fisik" class="col-sm-3 col-form-label">Deskripsi Fisik</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="deskripsi-fisik" name="deskripsi-fisik" placeholder="Masukkan deskripsi fisik">
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="halaman" class="col-sm-3 col-form-label">Jumlah Halaman</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="halaman" name="halaman" placeholder="Masukkan jumlah halaman">
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="jumlah-buku" class="col-sm-3 col-form-label">Jumlah Buku</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="jumlah-buku" name="jumlah-buku" placeholder="Masukkan jumlah buku">
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="cover-buku" class="col-sm-3 col-form-label">Cover Buku</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="file" id="cover-buku" name="cover_buku">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 d-flex justify-content-between">
                                <a href="{{ route('buku-pelajaran.buku.index') }}" class="btn btn-warning w-md"><i class="mdi mdi-backspace"></i> Kembali</a>
                                <button type="submit" id="button-submit-buku-pelajaran" class="btn btn-primary w-md"><i class="mdi mdi-content-save"></i> Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
            const date = new Date()
            let form = document.getElementById('form-buku-pelajaran');
            let buttonSubmit = document.getElementById('button-submit-buku-pelajaran');
            let messageNotEmpty = 'Wajib diisi';
            let messageStringMax = 'Hanya dapat diisi 255 karakter'
            let currentYear = date.getFullYear()

            buttonSubmit.addEventListener('click', (event) => {
                event.preventDefault();
                validator.validate().then(function (status) {
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
                        'judul': {
                            validators: {
                                notEmpty: { message: messageNotEmpty },
                                stringLength: { max: 255, message: messageStringMax }
                            }
                        },
                        'kota-terbit': {
                            validators: {
                                notEmpty: { message: messageNotEmpty },
                                stringLength: { max: 255, message: messageStringMax }
                            }
                        },
                        'penerbit': {
                            validators: {
                                notEmpty: { message: messageNotEmpty },
                                stringLength: { max: 255, message: messageStringMax }
                            }
                        },
                        'penulis': {
                            validators: {
                                notEmpty: { message: messageNotEmpty },
                                stringLength: { max: 255, message: messageStringMax }
                            }
                        },
                        'tahun-terbit': {
                            validators: {
                                notEmpty: { message: messageNotEmpty },
                                digits: { message: 'Hanya bisa berisikan angka' },
                                stringLength: {
                                    min: 4,
                                    max: 4,
                                    message: 'Hanya bisa diisikan empat digit'
                                },
                                between: {
                                    min: 1000,
                                    max: currentYear,
                                    message: 'Tahun terbit harus antara 1000 dan ' + currentYear
                                }
                            }
                        },
                        'isbn': {
                            validators: {
                                notEmpty: { message: messageNotEmpty },
                                isbn: { message: 'Format ISBN tidak valid (ISBN-10 atau ISBN-13)' }
                            }
                        },
                        'deskripsi-fisik': {
                            validators: {
                                notEmpty: { message: messageNotEmpty },
                                stringLength: { max: 255, message: messageStringMax }
                            }
                        },
                        'halaman': {
                            validators: {
                                notEmpty: { message: messageNotEmpty },
                                digits: { message: 'Hanya bisa berisikan angka' },
                                greaterThan: {
                                    min: 1,
                                    message: 'Jumlah halaman minimal 1'
                                }
                            }
                        },
                        'jumlah-buku': {
                            validators: {
                                notEmpty: { message: messageNotEmpty },
                                digits: { message: 'Hanya bisa berisikan angka' },
                                greaterThan: {
                                    min: 1,
                                    message: 'Jumlah buku minimal 1'
                                }
                            }
                        },
                        'cover_buku': {
                            validators: {
                                notEmpty: { message: 'Cover buku wajib diunggah' },
                                file: {
                                    extension: 'jpg,jpeg,png,webp',
                                    type: 'image/jpeg,image/png,image/webp',
                                    maxSize: 2 * 1024 * 1024, // 2 MB
                                    message: 'File harus berupa gambar (jpg, jpeg, png, webp) dengan ukuran maksimal 2 MB'
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