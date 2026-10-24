@extends('layouts.backoffice')
@section('title','Penempatan Siswa')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Kenaikan Kelas</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Kenaikan Kelas</li>
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
                        <div class="col-md-6">
                            <label for="uuid-ref-tahun-ajar">Tahun Ajar</label>
                            <select class="form-control select2" id="uuid-ref-tahun-ajar" name="uuid-ref-tahun-ajar">
                                <option value="">--- Pilih Tahun Ajar ---</option>
                                @foreach($listTahunAjar as $tahunAjar)
                                    <option value="{{ $tahunAjar->uuid }}">{{ $tahunAjar->tahun_ajar }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="uuid-ref-kelas">Kelas</label>
                            <select class="form-control select2" id="uuid-ref-kelas" name="uuid-ref-kelas">
                                <option value="">--- Pilih Kelas ---</option>
                                @foreach($listKelas as $kelas)
                                    <option value="{{ $kelas->uuid }}">{{ $kelas->kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-3 text-end">
                            <button type="submit" id="button-cari-siswa-kelas-tahun-ajar" class="btn btn-primary w-md waves-effect waves-light"><i class="mdi mdi-book-search"></i> Cari</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 d-none" id="row-kelas-xii-result">
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
                        <div class="col-sm-8">
                            <div class="text-sm-end">
                                <button type="button" class="btn btn-primary waves-effect waves-light addContact-modal mb-2" id="button-proses-kenaikan-kelas">
                                    <i class="mdi mdi-gradient me-1"></i> Proses Kenaikan Kelas
                                </button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered dt-responsive" id="table-kenaikan-kelas-siswa">
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
            let tahunAjar
            let kelas
            let datatables

            $("#button-cari-siswa-kelas-tahun-ajar").on('click',()=>{
                tahunAjar = $("#uuid-ref-tahun-ajar").val()
                kelas = $("#uuid-ref-kelas").val()

                if(kelas === '')
                {
                    Swal.fire({
                        text: "Wajib memilih kelas!",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Iya",
                        customClass: {
                            confirmButton: 'btn btn-primary px-4 me-2',
                        }
                    })
                }
                else
                {
                    $("#row-kelas-xii-result").removeClass('d-none')
                    datatables = $('#table-kenaikan-kelas-siswa').DataTable({
                        processing: true,
                        serverSide: true,
                        destroy: true,
                        ajax: {
                            url: '/datatables/kenaikan-kelas',
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                'uuid-ref-kelas': kelas,
                                'uuid-ref-tahun-ajar': tahunAjar
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
                    });
                }
            });

            $("#button-proses-kenaikan-kelas").on('click',()=>{
                Swal.fire({
                    text: "Apakah anda yakin untuk melakukan kenaikan kelas?",
                    icon: "question",
                    buttonsStyling: false,
                    confirmButtonText: "Iya",
                    showDenyButton: true,
                    denyButtonText: 'Tidak',
                    customClass: {
                        confirmButton: 'btn btn-primary waves-effect waves-light px-4 me-2',
                        denyButton: 'btn btn-danger waves-effect waves-light px-4'
                    }
                }).then((result)=>{
                    if (result.isConfirmed)
                    {
                        axios({
                            url: '/kenaikan-kelas/update',
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                'uuid-ref-kelas': $("#uuid-ref-kelas").val()
                            }
                        }).then(()=>{
                            $('#table-kenaikan-kelas-siswa').DataTable().ajax.reload(null, false);
                        }).catch((error)=>{
                            console.error(error)
                        })
                    }
                    else if (result.isDenied)
                    {
                        Swal.fire('Proses pembatalan kenaikan kelas dibatalkan', '', 'info')
                    }
                }).catch((error)=>{
                    console.error(error)
                })
            });
        })
    </script>
@endsection