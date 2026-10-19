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
                        <li class="breadcrumb-item active">Kejuruan</li>
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
                    <form id="form-buku-paket" method="post" action="{{ route('buku-paket.create.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="fv-row row mb-4">
                            <label for="kelas" class="col-sm-3 col-form-label">Kelas<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="select2 form-control" id="kelas" name="uuid-kelas">
                                    <option value="">--- Pilih Kelas ---</option>
                                    @foreach($listKelas as $kelas)
                                        <option value="{{ $kelas->uuid }}">{{ $kelas->kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="fv-row row mb-4">
                            <label for="kejuruan" class="col-sm-3 col-form-label">Kejuruan<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="select2 form-control" id="kejuruan" name="uuid-kejuruan">
                                    <option value="">--- Pilih Kejuruan ---</option>
                                    @foreach($listKejuruan as $kejuruan)
                                        <option value="{{ $kejuruan->uuid }}">{{ $kejuruan->kejuruan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="fv-row row mb-4">
                            <label for="buku" class="col-sm-3 col-form-label">Buku Pelajaran<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="select2 form-control" id="buku" name="uuid-buku-pelajaran">
                                    <option value="">--- Pilih Buku Pelajaran ---</option>
                                    @foreach($listBuku as $buku)
                                        <option value="{{ $buku->uuid }}">{{ $buku->judul }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 d-flex justify-content-between">
                                <a href="{{ route('buku-paket.index') }}" class="btn btn-warning w-md"><i class="mdi mdi-backspace"></i> Kembali</a>
                                <button type="submit" id="button-submit-buku-paket" class="btn btn-primary w-md"><i class="mdi mdi-content-save"></i> Submit</button>
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
            let form = document.getElementById('form-buku-paket');
            let buttonSubmit = document.getElementById('button-submit-buku-paket');
            let messageNotEmpty = 'Wajib diisi';
            let messageStringMax = 'Hanya dapat diisi 255 karakter'

            $("#kelas").select2()
            $("#kejuruan").select2()
            $("#buku").select2()

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
                        'uuid-kelas': {
                            validators: {
                                notEmpty: { message: messageNotEmpty },
                            },
                        },
                        'uuid-kejuruan': {
                            validators: {
                                notEmpty: { message: messageNotEmpty },
                            },
                        },
                        'uuid-buku-pelajaran': {
                            validators: {
                                notEmpty: { message: messageNotEmpty },
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

            $('#kelas').on('change', function () {
                validator.revalidateField('uuid-kelas');
            });
            $('#kejuruan').on('change', function () {
                validator.revalidateField('uuid-kejuruan');
            });
            $('#buku').on('change', function () {
                validator.revalidateField('uuid-buku-pelajaran');
            });
        });
    </script>
@endsection
