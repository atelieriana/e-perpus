@extends('layouts.backoffice')
@section('title','Dashboard')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Total Peminjaman</p>
                                    <h4 class="mb-0">{{ number_format($totalPeminjaman,0,',','.') }}</h4>
                                </div>
                                <div class="flex-shrink-0 align-self-center">
                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                        <span class="avatar-title">
                                            <i class="bx bx-copy-alt font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Siswa Aktif</p>
                                    <h4 class="mb-0">{{ number_format($dataSiswa,0,',','.') }}</h4>
                                </div>
                                <div class="flex-shrink-0 align-self-center">
                                    <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                        <span class="avatar-title rounded-circle bg-primary">
                                            <i class="bx bx-archive-in font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Total Buku</p>
                                    <h4 class="mb-0">{{ number_format($dataBuku,0,',','.') }}</h4>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                        <span class="avatar-title rounded-circle bg-primary">
                                            <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                        </span>="avatar-title rounded-circle bg-primary">
                                        <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4>Peminjaman Mendekati/Melewati Batas Akhir</h4>
                    <table class="table table-bordered dt-responsive" id="table-peminjaman-mendekati-batas-akhir">
                        <thead class="table-light">
                        <tr>
                            <th class="text-center">No <span class="text-muted" data-ic="sort" data-s="13"></span></th>
                            <th>Nomor Induk <span class="text-muted" data-ic="sort" data-s="13"></span></th>
                            <th>Nama Siswa <span class="text-muted" data-ic="sort" data-s="13"></span></th>
                            <th>Judul Buku <span class="text-muted" data-ic="sort" data-s="13"></span></th>
                            <th>Tanggal Awal Pinjam <span class="text-muted" data-ic="sort" data-s="13"></span></th>
                            <th>Tanggal Akhir Pinjam <span class="text-muted" data-ic="sort" data-s="13"></span></th>
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
            const table = $('#table-peminjaman-mendekati-batas-akhir').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/datatables/peminjaman-mendekati-batas-akhir',
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
                        data: 'nomor_induk',
                        name: 'nomor_induk'
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
                        data: 'tanggal_mulai_pinjam',
                        name: 'tanggal_mulai_pinjam'
                    },
                    {
                        data: 'tanggal_akhir_pinjam',
                        name: 'tanggal_akhir_pinjam'
                    }
                ],
            });
        });
    </script>
@endsection