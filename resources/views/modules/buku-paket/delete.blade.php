@extends('layouts.backoffice')
@section('title','Referensi Buku Paket')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Referensi Buku Paket</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('buku-paket.index') }}">Buku Paket</a></li>
                        <li class="breadcrumb-item active">Update</li>
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
                                <h4>Ubah Buku Paket</h4>
                            </div>
                        </div>
                    </div>
                    <form id="form-buku-paket" method="post" action="{{ route('buku-paket.delete.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="uuid-buku-paket" value="{{ $dataBukuPaket->uuid }}"/>
                        <div class="fv-row row mb-4">
                            <label for="kelas" class="col-sm-3 col-form-label">Kelas<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kelas" value="{{ $dataBukuPaket->ref_kelas->kelas }}" readonly/>
                            </div>
                        </div>
                        <div class="fv-row row mb-4">
                            <label for="kejuruan" class="col-sm-3 col-form-label">Buku Paket<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kejuruan" value="{{ $dataBukuPaket->ref_kejuruan->kejuruan }}" readonly/>
                            </div>
                        </div>
                        <div class="fv-row row mb-4">
                            <label for="buku" class="col-sm-3 col-form-label">Buku Pelajaran<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="buku" value="{{ $dataBukuPaket->ref_buku->judul }}" readonly/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 d-flex justify-content-between">
                                <a href="{{ route('buku-paket.index') }}" class="btn btn-warning w-md waves-effect waves-light"><i class="mdi mdi-backspace"></i> Kembali</a>
                                <button type="submit" id="button-submit-buku-paket" class="btn btn-danger w-md waves-effect waves-light"><i class="mdi mdi-trash-can"></i> Hapus</button>
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

            buttonSubmit.addEventListener('click', (event) => {
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
