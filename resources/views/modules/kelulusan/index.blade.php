@extends('layouts.backoffice')
@section('title','Penempatan Siswa')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Kelulusan</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Kelulusan</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @include('templates.notification')
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <label for="uuid-ref-tahun-ajar">Tahun Ajar</label>
                        <select class="form-control select2" id="uuid-ref-tahun-ajar" name="uuid-ref-tahun-ajar">
                            <option value="">--- Pilih Tahun Ajar ---</option>
                            @foreach($listTahunAjar as $tahunAjar)
                                <option value="{{ $tahunAjar->uuid }}">{{ $tahunAjar->tahun_ajar }} ({{ getIndonesianDate($tahunAjar->tanggal_mulai) . ' s.d. '. getIndonesianDate($tahunAjar->tanggal_akhir) }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-3 text-end">
                            <button type="submit" id="button-cari-siswa-kelas-xii" class="btn btn-primary w-md waves-effect waves-light"><i class="mdi mdi-book-search"></i> Cari</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="search-box me-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4>Daftar Siswa Kelas XII</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-end">
                                <a href="{{ route('kode-kelas.create') }}">
                                    <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light addContact-modal mb-2">
                                        <i class="mdi mdi-gradient me-1"></i> Proses Kelulusan
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered dt-responsive" id="table-siswa-kelas-xii">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">No <span class="text-muted" data-ic="sort" data-s="13"></span></th>
                                <th>NISN <span class="text-muted" data-ic="sort" data-s="13"></span></th>
                                <th>Nomor Induk <span class="text-muted" data-ic="sort" data-s="13"></span></th>
                                <th>Nama Lengkap <span class="text-muted" data-ic="sort" data-s="13"></span></th>
                                <th>Kelas <span class="text-muted" data-ic="sort" data-s="13"></span></th>
                                <th>Kejuruan <span class="text-muted" data-ic="sort" data-s="13"></span></th>
                                <th>Kode Kelas <span class="text-muted" data-ic="sort" data-s="13"></span></th>
                                <th>Tahun Ajar <span class="text-muted" data-ic="sort" data-s="13"></span></th>
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
            $("#uuid-ref-tahun-ajar").select2()
            $("#button-cari-siswa-kelas-xii").on('click',()=>{
                $("#row-kelas-xii-result").removeClass('d-none')
                $('#table-siswa-kelas-xii').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    ajax: {
                        url: '/datatables/siswa-kelas-xii',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            'uuid-ref-tahun-ajar': $("#uuid-ref-tahun-ajar").val()
                        }
                    },
                    columns: [{
                        data: null,
                        name: 'No',
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
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
                            data: 'kelas',
                            name: 'kelas'
                        },
                        {
                            data: 'kejuruan',
                            name: 'kejuruan'
                        },
                        {
                            data: 'kode_kelas',
                            name: 'kode_kelas'
                        },
                        {
                            data: 'tahun_ajar',
                            name: 'tahun_ajar'
                        },
                    ],
                })
            })
        });
    </script>
@endsection