@extends('layouts.backoffice')
@section('title','Kode Kelas')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Referensi Kode Kelas</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('kode-kelas.index') }}">Kode Kelas</a></li>
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
                                <h4>Ubah Kode Kelas</h4>
                            </div>
                        </div>
                    </div>
                    <form id="form-kode-kelas" method="post" action="{{ route('kode-kelas.update.submit') }}">
                        @csrf
                        <input type="hidden" name="uuid-kode-kelas" value="{{ $dataKodeKelas->uuid }}"/>
                        <div class="fv-row row mb-4">
                            <label for="kelas" class="col-sm-3 col-form-label">Kelas<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="uuid-kelas" class="form-control" id="kelas">
                                    <option value="">--- Pilih Kelas ---</option>
                                    @foreach($listKelas as $kelas)
                                        <option value="{{ $kelas->uuid }}" @selected((old('uuid-kelas') ? old('uuid-kelas') : $dataKodeKelas->ref_kelas->uuid) === $kelas->uuid)>{{ $kelas->kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="fv-row row mb-4">
                            <label for="kejuruan" class="col-sm-3 col-form-label">Kejuruan<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="uuid-kejuruan" class="form-control" id="kejuruan">
                                    <option value="">--- Pilih Kejuruan ---</option>
                                    @foreach($listKejuruan as $kejuruan)
                                        <option value="{{ $kejuruan->uuid }}" @selected((old('uuid-kejuruan') ? old('uuid-kejuruan') : $dataKodeKelas->ref_kejuruan->uuid) === $kejuruan->uuid)>{{ $kejuruan->kejuruan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="fv-row row mb-4">
                            <label for="kode-kelas" class="col-sm-3 col-form-label">Kode Kelas<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kode-kelas" name="kode-kelas" value="{{ (old('kode-kelas')) ? old('kode-kelas') : $dataKodeKelas->kode_kelas  }}" placeholder="Masukkan kode kelas">
                            </div>
                        </div>
                        <div class="fv-row row mb-4">
                            <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="deskripsi" name="deskripsi">{{ (old('deskripsi')) ? old('deskripsi') : $dataKodeKelas->deskripsi }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 d-flex justify-content-between">
                                <a href="{{ route('kode-kelas.index') }}" class="btn btn-warning w-md"><i class="mdi mdi-backspace"></i> Kembali</a>
                                <button type="submit" id="button-submit-kode-kelas" class="btn btn-primary w-md"><i class="mdi mdi-content-save"></i> Submit</button>
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
            let form = document.getElementById('form-kode-kelas');
            let buttonSubmit = document.getElementById('button-submit-kode-kelas');
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
                        'kode-kelas': {
                            validators: {
                                notEmpty: { message: messageNotEmpty },
                                stringLength: { max: 255, message: messageStringMax },
                                regexp: {
                                    regexp: "^[a-zA-Z -]+$",
                                    message: "Kode Kelas hanya boleh huruf"
                                }
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
