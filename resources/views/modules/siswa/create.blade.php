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
                    <form id="form-buku-umum" method="post" action="{{ route('siswa.create.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="fv-row row mb-4">
                            <label for="status-siswa" class="col-sm-3 col-form-label">Status Siswa<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status-siswa" id="status-siswa">
                                    <option value="">--- Pilih Status Siswa ---</option>
                                    @foreach($listStatusSiswa as $statusSiswa)
                                        <option value="{{ $statusSiswa->uuid }}">{{ $statusSiswa->status_siswa }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="nisn" class="col-sm-3 col-form-label">NISN<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nisn" name="nisn" value="{{ old('nisn') }}" placeholder="Masukkan NISN">
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="nomor-induk" class="col-sm-3 col-form-label">Nomor Induk<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nomor-induk" name="nomor-induk" value="{{ old('nomor-induk') }}" placeholder="Masukkan nomor induk">
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="nama-lengkap" class="col-sm-3 col-form-label">Nama Lengkap<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama-lengkap" name="nama-lengkap" value="{{ old('nama-lengkap') }}" placeholder="Masukkan nama lengkap siswa">
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="gender" class="col-sm-3 col-form-label">Gender<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="radio" name="gender" id="gender" value="1"/> Laki-Laki &nbsp;
                                <input type="radio" name="gender" id="gender" value="2"/> Perempuan
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 d-flex justify-content-between">
                                <a href="{{ route('buku-umum.index') }}" class="btn btn-warning w-md"><i class="mdi mdi-backspace"></i> Kembali</a>
                                <button type="submit" id="button-submit-buku-umum" class="btn btn-primary w-md"><i class="mdi mdi-content-save"></i> Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')

@endsection
