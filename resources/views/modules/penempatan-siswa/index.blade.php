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
        <div class="row" id="row-penempatan-result">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-12">
                                <div class="me-2 mb-2 d-inline-block">
                                    <div class="position-relative">
                                        <h5>Daftar Siswa Baru</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" id="render-list-siswa-tanpa-kelas"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-12">
                                <div class="me-2 mb-2 d-inline-block">
                                    <div class="position-relative">
                                        <h5>Daftar Penempatan Siswa</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" id="render-list-penempatan"></div>
                        </div>
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

            let requestListSiswaDenganKelas
            let requestListSiswaTanpaKelas
            let tahunAjar
            let kodeKelas

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
                kodeKelas = $("#kode-kelas").val()
                tahunAjar = $("#tahun-ajar").val()

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
                    requestListSiswaDenganKelas = () => axios({
                        url: '/async/penempatan-siswa',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            'uuid-ref-kode-kelas': kodeKelas,
                            'uuid-ref-tahun-ajar': tahunAjar,
                            'uuid-ref-kelas': kelas
                        }
                    }).then((response)=>{
                        let listData = response.data
                        $("#render-list-penempatan").html("")
                        listData.forEach((item)=>{
                            let html = '<h5>'+item.nama_lengkap+'</h5>' +
                                '<p class="badge rounded-pill bg-primary">NIS '+item.nomor_induk+' / NISN '+item.nisn+'</p></br> ' +
                                '<p class="badge rounded-pill bg-success">'+item.kejuruan+' - '+item.kode_kelas+'</p></br>' +
                                '<button type="button" class="btn btn-danger waves-effect btn-sm hapus-siswa" data-penempatan-uuid="'+item.uuid+'"><i class="mdi mdi-trash-can"></i> Hapus</button> ' +
                                '<hr class="my-2 border-primary border-1 opacity-50">'
                            $("#render-list-penempatan").append(html)
                        });
                        let buttonHapus = document.querySelectorAll(".hapus-siswa")
                        buttonHapus.forEach(element =>{
                            element.addEventListener('click',(event)=>{
                                let uuidSiswa = event.currentTarget.getAttribute('data-penempatan-uuid')
                                hapusSiswa(uuidSiswa)
                            })
                        })
                    }).catch((error)=>{
                        console.error(error);
                    });

                    requestListSiswaTanpaKelas = () => axios({
                        url: '/async/tanpa-kelas',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            'uuid-ref-tahun-ajar': tahunAjar,
                        }
                    }).then((response)=>{
                        let listData = response.data
                        $("#render-list-siswa-tanpa-kelas").html("")
                        listData.forEach((item)=> {
                            let html = '<h5>' + item.nama_lengkap + '</h5>' +
                                '<p class="badge rounded-pill bg-primary">NIS ' + item.nomor_induk + ' / NISN ' + item.nisn + '</p></br> ' +
                                '<button type="button" class="btn btn-primary waves-effect btn-sm tambah-siswa" data-uuid-siswa="'+item.uuid+'"><i class="mdi mdi-plus"></i> Tambahkan</button> ' +
                                '<hr class="my-2 border-primary border-1 opacity-50">'
                            $("#render-list-siswa-tanpa-kelas").append(html)
                        })
                        let buttonTambah = document.querySelectorAll(".tambah-siswa")
                        buttonTambah.forEach(element =>{
                            element.addEventListener('click',(event)=>{
                                let uuidSiswa = event.currentTarget.getAttribute('data-uuid-siswa')
                                tambahSiswa(uuidSiswa)
                            })
                        })
                    }).catch((error)=>{
                        console.error(error)
                    })

                    requestListSiswaTanpaKelas()
                    requestListSiswaDenganKelas()
                }
            })

            let hapusSiswa = (uuid) =>{
                axios({
                    url: '/async/hapus-dari-kelas',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'uuid-trans-penempatan-siswa': uuid,
                    }
                }).then(()=>{
                    requestListSiswaDenganKelas()
                    requestListSiswaTanpaKelas()
                }).catch((error)=>{
                    console.error(error)
                })
            }

            let tambahSiswa = (uuid) =>{
                axios({
                    url: '/async/tambah-ke-kelas',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'uuid-ref-siswa': uuid,
                        'uuid-ref-tahun-ajar': tahunAjar,
                        'uuid-ref-kode-kelas': kodeKelas
                    }
                }).then(()=>{
                    requestListSiswaDenganKelas()
                    requestListSiswaTanpaKelas()
                }).catch((error)=>{
                    console.error(error)
                })
            }
        })
    </script>
@endsection