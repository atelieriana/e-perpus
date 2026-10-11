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
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="search-box me-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4>Daftar Siswa</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered dt-responsive" id="table-siswa">
                        <thead class="table-light">
                        <tr>
                            <th class="align-middle">No</th>
                            <th class="align-middle">NISN</th>
                            <th class="align-middle">Nomor Induk</th>
                            <th class="align-middle">Nama Lengkap</th>
                            <th class="align-middle">Gender</th>
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
        $(document).ready(function() {
            const table = $('#table-siswa').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/datatables/siswa',
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
                        data: 'nisn',
                        name: 'nisn'
                    },
                    {
                        data: 'nomor_induk',
                        name: 'nomor_induk'
                    },
                    {
                        data: 'nama_lengkap',
                        name: 'nama_lengkap'
                    },
                    {
                        data: 'gender',
                        name: 'gender'
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
