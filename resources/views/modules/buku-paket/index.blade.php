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
                        <li class="breadcrumb-item active">Buku Paket</li>
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
                                    <h4>Daftar Buku Pelajaran</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-end">
                                <a href="{{ route('buku-pelajaran.create') }}">
                                    <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light addContact-modal mb-2">
                                        <i class="mdi mdi-plus me-1"></i> Tambah Buku Paket
                                    </button>
                                </a>
                            </div>
                        </div><!-- end col-->
                    </div>
                    <table class="table table-bordered dt-responsive" id="table-buku-paket">
                        <thead class="table-light">
                        <tr>
                            <th class="align-middle">No</th>
                            <th class="align-middle">Judul</th>
                            <th class="align-middle">Kelas</th>
                            <th class="align-middle">Kejuruan</th>
                            <th class="align-middle">Aksi</th>
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
            const table = $('#table-buku-paket').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/datatables/buku-paket',
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
                        data: 'judul',
                        name: 'judul'
                    },
                    {
                        data: 'kelas',
                        name: 'kelas'
                    },
                    {
                        data: 'kejuruan',
                        name: 'kejuruan'
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