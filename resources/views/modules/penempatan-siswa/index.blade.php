@extends('layouts.backoffice')
@section('title','Penempatan Siswa')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Penempatan Siswa</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Penempatan Siswa</li>
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
                        <div class="col-md-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <select class="form-control select2" id="kelas" name="uuid-kelas">
                                <option value="">--- Pilih Kelas ---</option>
                                @foreach($listKelas as $kelas)
                                    <option value="{{ $kelas->uuid }}">{{ $kelas->kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="kejuruan" class="form-label">Kejuruan</label>
                            <select class="form-control select2" id="kejuruan" name="uuid-jurusan">
                                <option value="">--- Pilih Kejuruan ---</option>
                                @foreach($listKejuruan as $kejuruan)
                                    <option value="{{ $kejuruan->uuid }}">{{ $kejuruan->kejuruan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="kode-kelas" class="form-label">Kode Kelas</label>
                            <select class="form-control select2" id="kode-kelas" name="uuid-kode-kelas">
                                <option value="">--- Pilih Kode Kelas ---</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="tahun-ajar" class="form-label">Tahun Ajar</label>
                            <select class="form-control select2" id="tahun-ajar" name="uuid-tahun-ajar">
                                <option value="">--- Pilih Tahun Ajar ---</option>
                                @foreach($listTahunAjar as $tahunAjar)
                                    <option value="{{ $tahunAjar->uuid }}">{{ $tahunAjar->tahun_ajar }} ({{ getIndonesianDate($tahunAjar->tanggal_mulai) . ' s.d. '. getIndonesianDate($tahunAjar->tanggal_akhir) }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-3 text-end">
                            <button type="submit" id="button-cari-penempatan" class="btn btn-primary w-md waves-effect waves-light"><i class="mdi mdi-book-search"></i> Cari</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-none" id="row-penempatan-result">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered dt-responsive" id="table-penempatan-siswa">
                            <thead class="table-light">
                            <tr>
                                <th class="align-middle">No</th>
                                <th class="align-middle">NISN</th>
                                <th class="align-middle">Nomor Induk</th>
                                <th class="align-middle">Nama</th>
                                <th class="align-middle">Gender</th>
                                <th class="align-middle">Aksi</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script>
        $(document).ready(function() {
            $("#kelas").select2()
            $("#kejuruan").select2()
            $("#kode-kelas").select2()
            $("#tahun-ajar").select2()

            $("#kejuruan, #kelas").on('change',()=>{
                let kelas = $("#kelas").val()
                let kejuruan = $("#kejuruan").val()

                if (kelas !== "" && kejuruan !== "")
                {
                    axios({
                        url: '/async/kode-kelas',
                        method: 'POST',
                        data: {
                            'uuid-kelas': kelas,
                            'uuid-kejuruan': kejuruan
                        }
                    }).then((response)=>{
                        let listKodeKelas = response.data
                        $("#kode-kelas").html('<option value="">--- Pilih Kode Kelas ---</option>')
                        listKodeKelas.forEach((item)=>{
                            $('#kode-kelas').append('<option value="'+item.uuid+'">'+item.kode_kelas+'</option>')
                        })
                    }).catch((error)=>{
                        console.log(error)
                    })
                }
            });

            $("#button-cari-penempatan").on('click',()=>{
                let kelas = $("#kelas").val()
                let kejuruan = $("#kejuruan").val()
                let kodeKelas = $("#kode-kelas").val()
                let tahunAjar = $("#tahun-ajar").val()

                if (kelas === "" || kejuruan === "" || kodeKelas === "" || tahunAjar === "")
                {
                    Swal.fire({
                        text: "Harap pilih kelas, jurusan, dan tahun ajar terlebih dahulu",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    })
                }
                else
                {
                    $("#row-penempatan-result").removeClass('d-none')
                    const table = $('#table-penempatan-siswa').DataTable({
                        processing: true,
                        serverSide: true,
                        destroy: true,
                        ajax: {
                            url: '/datatables/penempatan-siswa',
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                'uuid-ref-kelas': kelas,
                                'uuid-ref-kode-kelas': kodeKelas,
                                'uuid-ref-tahun-ajar': tahunAjar,
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
                                data: 'jenis_kelamin',
                                name: 'jenis_kelamin'
                            },
                            {
                                data: 'aksi',
                                name: 'aksi'
                            },
                        ],
                    });
                }
            })
        })
    </script>
@endsection