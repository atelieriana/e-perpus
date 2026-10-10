@extends('layouts.backoffice')
@section('title','Referensi Buku Pelajaran')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Referensi Buku</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('buku-pelajaran.index') }}">Buku Pelajaran</a></li>
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
                                <h4>Ubah Buku Pelajaran</h4>
                            </div>
                        </div>
                    </div>
                    <form id="form-buku-pelajaran" method="post" action="{{ route('buku-pelajaran.delete.submit') }}">
                        @csrf
                        <input type="hidden" name="uuid-buku" value="{{ $dataBuku->uuid }}"/>
                        <div class="fv-row row mb-4">
                            <label for="judul" class="col-sm-3 col-form-label">Judul Buku</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') ?? $dataBuku->judul }}" placeholder="Masukkan judul buku" disabled>
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="kota-terbit" class="col-sm-3 col-form-label">Kota Terbit</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kota-terbit" name="kota-terbit" value="{{ old('kota-terbit') ?? $dataBuku->kota_terbit }}" placeholder="Masukkan kota terbit" disabled>
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="penerbit" class="col-sm-3 col-form-label">Penerbit</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{ old('penerbit') ?? $dataBuku->penerbit }}" placeholder="Masukkan penerbit" disabled>
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="penulis" class="col-sm-3 col-form-label">Penulis</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="penulis" name="penulis" value="{{ old('penulis') ?? $dataBuku->penulis }}" placeholder="Masukkan penulis" disabled>
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="tahun-terbit" class="col-sm-3 col-form-label">Tahun Terbit</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="tahun-terbit" name="tahun-terbit" value="{{ old('tahun-terbit') ?? $dataBuku->tahun_terbit }}" placeholder="Masukkan tahun terbit" disabled>
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="isbn" class="col-sm-3 col-form-label">ISBN</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="isbn" name="isbn" value="{{ old('isbn') ?? $dataBuku->isbn }}" placeholder="Masukkan ISBN" disabled>
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="deskripsi-fisik" class="col-sm-3 col-form-label">Deskripsi Fisik</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="deskripsi-fisik" name="deskripsi-fisik" value="{{ old('deskripsi-fisik') ?? $dataBuku->deskripsi_fisik }}" placeholder="Masukkan deskripsi fisik" disabled>
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="halaman" class="col-sm-3 col-form-label">Jumlah Halaman</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="halaman" name="halaman" value="{{ old('halaman') ?? $dataBuku->halaman }}" placeholder="Masukkan jumlah halaman" disabled>
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="jumlah-buku" class="col-sm-3 col-form-label">Jumlah Buku</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="jumlah-buku" name="jumlah-buku" value="{{ old('jumlah-buku') ?? $dataBuku->jumlah_buku }}" placeholder="Masukkan jumlah buku" disabled>
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="cover-buku" class="col-sm-3 col-form-label">Cover Buku</label>
                            <div class="col-sm-9">
                                @if(!is_null($dataBuku->file_cover))
                                    <p class="mt-1">Cover buku</p>
                                    <img src="{{ getFile($dataBuku->file_cover) }}" alt="cover-buku" class="img-fluid" width="20%">
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 d-flex justify-content-between">
                                <a href="{{ route('buku-pelajaran.index') }}" class="btn btn-warning w-md"><i class="mdi mdi-backspace"></i> Kembali</a>
                                <button type="submit" id="button-submit-buku-pelajaran" class="btn btn-danger w-md"><i class="mdi mdi-trash-can"></i> Hapus</button>
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
            let form = document.getElementById('form-buku-pelajaran');
            let buttonSubmit = document.getElementById('button-submit-buku-pelajaran');

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