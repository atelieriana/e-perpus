@extends('layouts.backoffice')
@section('title','Penempatan Siswa')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Peminjaman Buku Umum</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Peminjaman Buku Umum</li>
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
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="search-box me-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4>Daftar Peminjaman Buku Umum</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-end">
                                <a href="{{ route('peminjaman-buku-umum.create') }}">
                                    <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light addContact-modal mb-2">
                                        <i class="mdi mdi-plus me-1"></i> Tambah Peminjaman Buku Umum
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered dt-responsive" id="table-buku-peminjaman-umum">
                        <thead class="table-light">
                        <tr>
                            <th class="align-middle">No</th>
                            <th class="align-middle">Nama</th>
                            <th class="align-middle">Buku</th>
                            <th class="align-middle">Tanggal Peminjaman</th>
                            <th class="align-middle">Tanggal Terakhir Peminjaman</th>
                            <th class="align-middle" style="width: 5em">Aksi</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script>
        $(document).ready(function(){
            const table = $('#table-buku-peminjaman-umum').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/datatables/peminjaman-buku-umum',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                },
                columns: [{
                    data: null,
                    name: 'No',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                    {
                        data: 'nama_lengkap',
                        name: 'nama_lengkap'
                    },
                    {
                        data: 'buku',
                        name: 'buku'
                    },
                    {
                        data: 'tanggal_mulai_pinjam',
                        name: 'tanggal_mulai_pinjam'
                    },
                    {
                        data: 'tanggal_akhir_pinjam',
                        name: 'tanggal_akhir_pinjam'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                ],
            });
        });
    </script>
@endsection