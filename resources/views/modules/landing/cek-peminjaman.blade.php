@extends('layouts.landing')
@section('title','Halaman Utama')
@section('content')
    <div class="row text-center mb-5">
        <h1>Cek Status Peminjaman Buku SMK SAKTI GEMOLONG</h1>
        <p>
            Cek seluruh status peminjaman buku anda, hibah buku, dan surat bebas perpustakaan.
        </p>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @include('templates.notification')
        </div>
        <div class="card" style="border-radius: 15px">
            <div class="card-body">
                <form action="{{ route('cek-peminjaman') }}" method="get">
                    <div class="row mb-3">
                        <div class="input-group">
                            <div class="input-group-text">
                                <i class="fa fa-search"></i>
                            </div>
                            <input type="text" class="form-control" name="pencarian" id="pencarian-buku" placeholder="Masukkan Nomor Induk">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-2 text-end">
                            <button type="submit" id="button-cari-siswa-kelas-tahun-ajar" class="btn btn-primary w-md waves-effect waves-light"><i class="mdi mdi-book-search"></i> Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if(isset($listPeminjaman))
        <div class="row">
            <div class="card" style="border-radius: 15px">
                <div class="card-body">
                    <div class="row">
                        <h5 style="color: #34C38F"><i class="fa fa-bookmark"></i> History Peminjaman Buku</h5>
                    </div>
                    <div class="row">
                        <table class="table table-bordered dt-responsive" width="100%" id="table-history-peminjaman">
                            <thead class="table-light">
                            <tr>
                                <th class="align-middle">No</th>
                                <th class="align-middle">Nama</th>
                                <th class="align-middle">Buku</th>
                                <th class="align-middle">Jenis Peminjaman</th>
                                <th class="align-middle">Tanggal Peminjaman</th>
                                <th class="align-middle">Tanggal Pengembalian</th>
                                <th class="align-middle">Status Peminjaman</th>
                                <th class="align-middle">Kelas Saat Peminjaman</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(isset($dataHibah))
        <div class="row">
            <div class="card" style="border-radius: 15px">
                <div class="card-body">
                    <div class="row">
                        <h5 style="color: #34C38F"><i class="fa fa-bookmark"></i> Hibah Buku</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <img src="{{ asset('images/palceholder.jpg') }}" alt="cover-buku" class="img-fluid"/>
                        </div>
                        <div class="col-md-11">
                            <h5>{{ $dataHibah->judul }}</h5>
                            <p>{{ $dataHibah->penulis }}</p>
                            <p>{{ $dataHibah->tahun_terbit }}</p>
                            <p>{{ $dataHibah->halaman }} halaman</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(isset($dataSuratBebasPerpusatakaan))
        <div class="row">
            <div class="card" style="border-radius: 15px">
                <div class="card-body">
                    <div class="row">
                        <h5 style="color: #34C38F"><i class="fa fa-bookmark"></i> History Peminjaman Buku</h5>
                    </div>
                    <div class="row">
                        <a href="{{ route('download',['nomorInduk' => request()->input('pencarian')]) }}">Surat Bebas Perpustakaan</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('custom-script')
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const pencarian = urlParams.get('pencarian');
        const table = $('#table-history-peminjaman').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            scrollX: true,
            responsive: true,
            ajax: {
                url: '/datatables/history-peminjaman',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'uuid-ref-siswa': pencarian
                }
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
                    data: 'judul',
                    name: 'judul'
                },
                {
                    data: 'jenis_peminjaman',
                    name: 'jenis_peminjaman'
                },
                {
                    data: 'tanggal_mulai_pinjam',
                    name: 'tanggal_mulai_pinjam'
                },
                {
                    data: 'tanggal_pengembalian',
                    name: 'tanggal_pengembalian'
                },
                {
                    data: 'status_peminjaman',
                    name: 'status_peminjaman'
                },
                {
                    data: 'kelas_saat_peminjaman',
                    name: 'kelas_saat_peminjaman'
                },
            ],
        });
    </script>
@endsection