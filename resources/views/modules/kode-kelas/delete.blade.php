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
                    <form id="form-kode-kelas" method="post" action="{{ route('kode-kelas.delete.submit') }}">
                        @csrf
                        <input type="hidden" name="uuid-kode-kelas" value="{{ $dataKodeKelas->uuid }}"/>
                        <div class="fv-row row mb-4">
                            <label for="kelas" class="col-sm-3 col-form-label">Kelas<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kelas" name="kelas" value="{{ $dataKodeKelas->ref_kelas->kelas }}"/>
                            </div>
                        </div>
                        <div class="fv-row row mb-4">
                            <label for="kejuruan" class="col-sm-3 col-form-label">Kejuruan<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kejuruan" name="kejuruan" value="{{ $dataKodeKelas->ref_kejuruan->kejuruan }}"/>
                            </div>
                        </div>
                        <div class="fv-row row mb-4">
                            <label for="kode-kelas" class="col-sm-3 col-form-label">Kode Kelas<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kode-kelas" name="kode-kelas" value="{{ $dataKodeKelas->kode_kelas }}" placeholder="Masukkan kode kelas">
                            </div>
                        </div>
                        <div class="fv-row row mb-4">
                            <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="deskripsi" name="deskripsi">{{ $dataKodeKelas->deskripsi }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 d-flex justify-content-between">
                                <a href="{{ route('kode-kelas.index') }}" class="btn btn-warning w-md"><i class="mdi mdi-backspace"></i> Kembali</a>
                                <button type="submit" id="button-submit-kode-kelas" class="btn btn-danger w-md"><i class="mdi mdi-trash-can"></i> Hapus</button>
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

            buttonSubmit.addEventListener('click', (event) => {
                event.preventDefault();
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
            });
        });
    </script>
@endsection
