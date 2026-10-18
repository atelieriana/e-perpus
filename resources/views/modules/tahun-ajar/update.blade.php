@extends('layouts.backoffice')
@section('title','Referensi Tahun Ajar')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Referensi Tahun Ajar</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('tahun-ajar.index') }}">Tahun Ajar</a></li>
                        <li class="breadcrumb-item active">Ubah</li>
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
                                <h4>Ubah Tahun Ajar</h4>
                            </div>
                        </div>
                    </div>
                    <form id="form-tahun-ajar" method="post" action="{{ route('tahun-ajar.update.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="uuid-tahun-ajar" value="{{ $dataTahunAjar->uuid }}"/>
                        <div class="fv-row row mb-4">
                            <label for="tahun-ajar" class="col-sm-3 col-form-label">Nama Tahun Ajar<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="tahun-ajar" name="tahun-ajar" value="{{ (old('tahun-ajar')) ? old('tahun-ajar') : $dataTahunAjar->tahun_ajar }}" placeholder="Masukkan tahun ajar (contoh: 2025/2026)" required>
                            </div>
                        </div>
                        <div class="fv-row row mb-4">
                            <label for="tanggal-mulai" class="col-sm-3 col-form-label">Tanggal Mulai<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="tanggal-mulai" name="tanggal-mulai" value="{{ (old('tanggal-mulai')) ? old('tanggal-mulai') : $dataTahunAjar->tanggal_mulai }}" required>
                            </div>
                        </div>
                        <div class="fv-row row mb-4">
                            <label for="tanggal-akhir" class="col-sm-3 col-form-label">Tanggal Akhir<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="tanggal-akhir" name="tanggal-akhir" value="{{ (old('tanggal-akhir')) ? old('tanggal-akhir') : $dataTahunAjar->tanggal_akhir }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 d-flex justify-content-between">
                                <a href="{{ route('tahun-ajar.index') }}" class="btn btn-warning w-md"><i class="mdi mdi-backspace"></i> Kembali</a>
                                <button type="submit" id="button-submit-tahun-ajar" class="btn btn-primary w-md"><i class="mdi mdi-content-save"></i> Submit</button>
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
            let form = document.getElementById('form-tahun-ajar');
            let buttonSubmit = document.getElementById('button-submit-tahun-ajar');
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
                        'tahun-ajar': {
                            validators: {
                                notEmpty: { message: messageNotEmpty },
                                stringLength: { max: 255, message: messageStringMax },
                                regexp: {
                                    regexp: /^\d{4}\s*\/\s*\d{4}$/,
                                    message: "Format tahun ajar hanya bisa xxxx/xxxx atau xxxx / xxxx"
                                }
                            },
                        },
                        'tanggal-mulai': {
                            validators: {
                                notEmpty: { message: messageNotEmpty },
                                date: { format: 'YYYY-MM-DD', message: 'Tanggal invalid' }
                            }
                        },
                        'tanggal-akhir': {
                            validators: {
                                notEmpty: { message: messageNotEmpty },
                                date: { format: 'YYYY-MM-DD', message: 'Tanggal invalid' }
                            }
                        }
                    },
                    plugins: {
                        startEndDate: new FormValidation.plugins.StartEndDate({
                            format: 'YYYY-MM-DD',
                            startDate: {
                                field: 'tanggal-mulai',
                                message: 'Tanggal mulai harus lebih awal dari tanggal akhir'
                            },
                            endDate: {
                                field: 'tanggal-akhir',
                                message: 'Tanggal akhir tidak boleh lebih awal dari tanggal mulai'
                            }
                        }),
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
