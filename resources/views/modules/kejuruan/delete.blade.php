@extends('layouts.backoffice')
@section('title','Referensi Kejuruan')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Referensi Kejuruan</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('kejuruan.index') }}">Kejuruan</a></li>
                        <li class="breadcrumb-item active">Hapus</li>
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
                                <h4>Hapus Kejuruan</h4>
                            </div>
                        </div>
                    </div>
                    <form id="form-kejuruan" method="post" action="{{ route('kejuruan.delete.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="uuid" value="{{ $dataKejuruan->uuid }}"/>
                        <div class="fv-row row mb-4">
                            <label for="kejuruan" class="col-sm-3 col-form-label">Nama Kejuruan<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kejuruan" name="kejuruan" value="{{ $dataKejuruan->kejuruan }}" placeholder="Masukkan kejuruan" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 d-flex justify-content-between">
                                <a href="{{ route('kejuruan.index') }}" class="btn btn-warning w-md"><i class="mdi mdi-backspace"></i> Kembali</a>
                                <button type="submit" id="button-submit-kejuruan" class="btn btn-primary w-md"><i class="mdi mdi-content-save"></i> Submit</button>
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
            let form = document.getElementById('form-kejuruan');
            let buttonSubmit = document.getElementById('button-submit-kejuruan');
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
                        'status-kejuruan': {
                            validators: {
                                notEmpty: { message: messageNotEmpty },
                                stringLength: { max: 255, message: messageStringMax }
                            },
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
