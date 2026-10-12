@extends('layouts.backoffice')
@section('title','Referensi Siswa')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Referensi Siswa</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Siswa</li>
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
                                <h4>Tambah Buku Umum</h4>
                            </div>
                        </div>
                    </div>
                    <form id="form-siswa" method="post" action="{{ route('siswa.create.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="fv-row row mb-4">
                            <label for="status-siswa" class="col-sm-3 col-form-label">Status Siswa<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status-siswa" id="status-siswa">
                                    <option value="">--- Pilih Status Siswa ---</option>
                                    @foreach($listStatusSiswa as $statusSiswa)
                                        <option value="{{ $statusSiswa->uuid }}" @selected((old('status-siswa')) ? old('status-siswa') : $dataSiswa->status_siswa->uuid == $statusSiswa->uuid)>{{ $statusSiswa->status_siswa }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="nisn" class="col-sm-3 col-form-label">NISN<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nisn" name="nisn" value="{{ (old('nisn') ? old('nisn') : $dataSiswa->nisn) }}" placeholder="Masukkan NISN">
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="nomor-induk" class="col-sm-3 col-form-label">Nomor Induk<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nomor-induk" name="nomor-induk" value="{{ (old('nomor-induk')) ? old('nisn') : $dataSiswa->nomor_induk }}" placeholder="Masukkan nomor induk">
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="nama-lengkap" class="col-sm-3 col-form-label">Nama Lengkap<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama-lengkap" name="nama-lengkap" value="{{ (old('nama-lengkap')) ? old('nama-lengkap') : $dataSiswa->nama_lengkap }}" placeholder="Masukkan nama lengkap siswa">
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="gender" class="col-sm-3 col-form-label">Gender<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="radio" name="gender" id="gender" value="1" @checked((old('gender')) ? old('gender') : $dataSiswa->gender == 1)/> Laki-Laki &nbsp;&nbsp;
                                <input type="radio" name="gender" id="gender" value="2" @selected((old('gender')) ? old('gender') : $dataSiswa->gender == 2)/> Perempuan
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 d-flex justify-content-between">
                                <a href="{{ route('buku-umum.index') }}" class="btn btn-warning w-md"><i class="mdi mdi-backspace"></i> Kembali</a>
                                <button type="submit" id="button-submit-siswa" class="btn btn-primary w-md"><i class="mdi mdi-content-save"></i> Submit</button>
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
            let form = document.getElementById('form-siswa');
            let buttonSubmit = document.getElementById('button-submit-siswa');
            let messageNotEmpty = 'Wajib diisi';
            let messageStringMax = 'Hanya dapat diisi 255 karakter'

            buttonSubmit.addEventListener('click', (event) => {
                event.preventDefault();
                validator.validate().then(function (status) {
                    if (status === 'Valid') {
                        buttonSubmit.disabled = true;
                        Swal.fire({
                            text: "Mohon menunggu kami sedang memverifikasi isian form",
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
                        'status-siswa': {
                            validators: {
                                notEmpty: { message: messageNotEmpty },
                                stringLength: { max: 255, message: messageStringMax }
                            },
                        },
                        'nisn': {
                            validators: {
                                notEmpty: { message: messageNotEmpty },
                                digits: { message: 'Hanya bisa berisikan angka' },
                                regexp: {
                                    regexp: "^^\\d{10}$",
                                    message: "NISN harus berisikan 10 digit"
                                }
                            },
                        },
                        'nomor-induk': {
                            validators: {
                                notEmpty: { message: messageNotEmpty },
                                digits: { message: 'Hanya bisa berisikan angka' },
                                greaterThan: {
                                    min: 1,
                                    message: 'Nomor induk minimal 1 digit'
                                }
                            }
                        },
                        'nama-lengkap': {
                            validators: {
                                notEmpty: { message: messageNotEmpty },
                                stringLength: { max: 255, message: messageStringMax },
                            }
                        },
                        'gender': {
                            validators: {
                                notEmpty: { message: messageNotEmpty }
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
