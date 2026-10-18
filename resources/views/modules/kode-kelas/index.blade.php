@extends('layouts.backoffice')
@section('title','Kode Kelas')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-start justify-content-between">
                <div>
                    <h4 class="mb-1">Referensi Kode Kelas</h4>
                </div>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Kode Kelas</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @include('templates.notification')
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="search-box me-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4>Daftar Kode Kelas</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-end">
                                <a href="{{ route('kode-kelas.create') }}">
                                    <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light addContact-modal mb-2">
                                        <i class="mdi mdi-plus me-1"></i> Tambah Kode Kelas
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered dt-responsive" id="table-kode-kelas">
                        <thead class="table-light">
                        <tr>
                            <th class="text-center">No <span class="text-muted" data-ic="sort" data-s="13"></span></th>
                            <th>Kode Kelas <span class="text-muted" data-ic="sort" data-s="13"></span></th>
                            <th>Jurusan / Program Keahlian <span class="text-muted" data-ic="sort" data-s="13"></span></th>
                            <th>Tingkat / Kelompok <span class="text-muted" data-ic="sort" data-s="13"></span></th>
                            <th>Deskripsi</th>
                            <th class="text-center">Aksi</th>
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
            const table = $('#table-kode-kelas').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/datatables/kode-kelas',
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
                        data: 'kode_kelas',
                        name: 'kode_kelas'
                    },
                    {
                        data: 'kejuruan',
                        name: 'kejuruan'
                    },
                    {
                        data: 'kelas',
                        name: 'kelas'
                    },
                    {
                        data: 'deskripsi',
                        name: 'deskripsi'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    }
                ],
            });
        });
    </script>
@endsection