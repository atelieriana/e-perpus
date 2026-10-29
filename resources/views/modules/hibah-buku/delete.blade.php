@extends('layouts.backoffice')
@section('title','Hibah Buku')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Hibah Buku</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('hibah-buku.index') }}">Hibah</a></li>
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
                                <h4>Hapus Hibah Buku</h4>
                            </div>
                        </div>
                    </div>
                    <form id="form-buku-umum" method="post" action="{{ route('hibah-buku.delete.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="uuid-trans-hibah" value="{{ $dataHibahBuku->uuid }}"/>
                        <input type="hidden" name="uuid-ref-buku" value="{{ $dataHibahBuku->ref_buku->uuid }}"/>
                        <div class="fv-row row mb-4">
                            <label for="kejuruan" class="col-sm-3 col-form-label">Kejuruan<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $dataHibahBuku->ref_siswa->trans_penempatan_latest->ref_kode_kelas->ref_kejuruan->kejuruan }}"/>
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="kode-kelas" class="col-sm-3 col-form-label">Kode Kelas<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $dataHibahBuku->ref_siswa->trans_penempatan_latest->ref_kode_kelas->kode_kelas }}"/>
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="tahun-ajar" class="col-sm-3 col-form-label">Tahun Ajar<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $dataHibahBuku->ref_siswa->trans_penempatan_latest->ref_tahun_ajar->tahun_ajar }}"/>
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="siswa" class="col-sm-3 col-form-label">Nama Siswa/Siswi<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $dataHibahBuku->ref_siswa->nama_lengkap }}"/>
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="judul" class="col-sm-3 col-form-label">Judul Buku<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="judul" name="judul" value="{{ $dataHibahBuku->ref_buku->judul }}" placeholder="Masukkan judul buku" readonly>
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="kota-terbit" class="col-sm-3 col-form-label">Kota Terbit<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kota-terbit" name="kota-terbit" value="{{ $dataHibahBuku->ref_buku->kota_terbit }}" placeholder="Masukkan kota terbit" readonly>
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="penerbit" class="col-sm-3 col-form-label">Penerbit<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{ $dataHibahBuku->ref_buku->penerbit }}" placeholder="Masukkan penerbit" readonly>
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="penulis" class="col-sm-3 col-form-label">Penulis<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="penulis" name="penulis" value="{{ $dataHibahBuku->ref_buku->penulis }}" placeholder="Masukkan penulis" readonly>
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="tahun-terbit" class="col-sm-3 col-form-label">Tahun Terbit<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="tahun-terbit" name="tahun-terbit" value="{{ $dataHibahBuku->ref_buku->tahun_terbit }}" placeholder="Masukkan tahun terbit" readonly>
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="isbn" class="col-sm-3 col-form-label">ISBN<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="isbn" name="isbn" value="{{ $dataHibahBuku->ref_buku->isbn }}" placeholder="Masukkan ISBN" readonly>
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="deskripsi-fisik" class="col-sm-3 col-form-label">Deskripsi Fisik<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="deskripsi-fisik" name="deskripsi-fisik" value="{{ $dataHibahBuku->ref_buku->deskripsi_fisik }}" placeholder="Masukkan deskripsi fisik" readonly>
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="halaman" class="col-sm-3 col-form-label">Jumlah Halaman<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="halaman" name="halaman" value="{{ $dataHibahBuku->ref_buku->halaman }}" placeholder="Masukkan jumlah halaman" readonly>
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="jumlah-buku" class="col-sm-3 col-form-label">Jumlah Buku<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="jumlah-buku" name="jumlah-buku" value="{{ $dataHibahBuku->ref_buku->jumlah_buku }}" placeholder="Masukkan jumlah buku" readonly>
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="cover-buku" class="col-sm-3 col-form-label">Cover Buku</label>
                            <div class="col-sm-9">
                                @if(!is_null($dataHibahBuku->ref_buku->file_cover))
                                    <p class="mt-1">Cover buku saat ini</p>
                                    <img src="{{ getFile($dataHibahBuku->ref_buku->file_cover) }}" alt="cover-buku" class="img-fluid" width="20%">
                                @else
                                    -
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 d-flex justify-content-between">
                                <a href="{{ route('hibah-buku.index') }}" class="btn btn-warning w-md"><i class="mdi mdi-backspace"></i> Kembali</a>
                                <button type="submit" id="button-submit-hibah-buku" class="btn btn-danger w-md"><i class="mdi mdi-trash-can"></i> Hapus</button>
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
            let form = document.getElementById('form-buku-umum');
            let buttonSubmit = document.getElementById('button-submit-hibah-buku');

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