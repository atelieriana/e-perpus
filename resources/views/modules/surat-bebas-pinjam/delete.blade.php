@extends('layouts.backoffice')
@section('title','Surat Bebas Pinjam')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Surat Bebas Pinjam</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('surat-bebas-pinjam.index') }}">Surat Bebas Pinjam</a></li>
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
        <form id="form-surat-bebas-pinjam" method="post" action="{{ route('surat-bebas-pinjam.delete.submit') }}">
            <input type="hidden" name="uuid-trans-surat-bebas-pinjam" value="{{ $dataSuratBebasPinjam->uuid }}"/>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-sm-4">
                            <div class="search-box me-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4>Hapus Surat Bebas Pinjam</h4>
                                </div>
                            </div>
                        </div>
                        @csrf
                        <div class="fv-row row mb-4">
                            <label for="tanggal-surat" class="col-sm-3 col-form-label">Nama Lengkap<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="tanggal-surat" value="{{ $dataSiswa->nama_lengkap }}" readonly>
                            </div>
                        </div>
                        <div class="fv-row row mb-4">
                            <label for="tanggal-surat" class="col-sm-3 col-form-label">Tanggal Surat Bebas Peminjaman<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="tanggal-surat" name="tanggal-surat-bebas-peminjaman" value="{{ $dataSuratBebasPinjam->tanggal_surat }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 d-flex justify-content-between">
                                <a href="{{ route('surat-bebas-pinjam.index') }}" class="btn btn-warning w-md"><i class="mdi mdi-backspace"></i> Kembali</a>
                                <button type="submit" id="button-submit-surat-bebas-pinjam" class="btn btn-danger w-md"><i class="mdi mdi-content-save"></i> Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('custom-script')
    <script>
        $(document).ready(()=>{
            let form = document.getElementById('form-surat-bebas-pinjam');
            let buttonSubmit = document.getElementById('button-submit-surat-bebas-pinjam');

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
        })
    </script>
@endsection