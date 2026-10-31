@extends('layouts.backoffice')
@section('title','Surat Bebas Pinjam')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Surat Bebas Pinjam</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Surat Bebas Pinjam</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @include('templates.notification')
        </div>
        <form id="form-surat-bebas-pinjam" method="post" action="{{ route('surat-bebas-pinjam.create.submit') }}">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-sm-4">
                            <div class="search-box me-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4>Buat Surat Bebas Pinjam</h4>
                                </div>
                            </div>
                        </div>
                        @csrf
                        <div class="fv-row row mb-4">
                            <label for="kelas" class="col-sm-3 col-form-label">Kelas<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="uuid-ref-kelas" id="kelas">
                                    <option value="">--- Pilih Kelas ---</option>
                                    @foreach($listKelas as $kelas)
                                        <option value="{{ $kelas->uuid}}" @selected(old('uuid-ref-kelas') === $kelas->uuid)>{{ $kelas->kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="kejuruan" class="col-sm-3 col-form-label">Kejuruan<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="uuid-ref-kejuruan" id="kejuruan">
                                    <option value="">--- Pilih Kejuruan ---</option>
                                    @foreach($listKejuruan as $kejuruan)
                                        <option value="{{ $kejuruan->uuid }}" @selected(old('uuid-ref-kejuruan') === $kejuruan->uuid)>{{ $kejuruan->kejuruan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="kode-kelas" class="col-sm-3 col-form-label">Kode Kelas<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="uuid-ref-kode-kelas" id="kode-kelas">
                                    <option value="">--- Pilih Kode Kelas ---</option>
                                    @if(!is_null($listKodeKelas))
                                        @foreach($listKodeKelas as $kodeKelas)
                                            <option value="{{ $kodeKelas->uuid }}" @selected(old('uuid-ref-kode-kelas') === $kodeKelas->uuid)>{{ $kodeKelas->kode_kelas }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="tahun-ajar" class="col-sm-3 col-form-label">Tahun Ajar<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="uuid-ref-tahun-ajar" id="tahun-ajar">
                                    <option value="">--- Pilih Tahun Ajar ---</option>
                                    @foreach($listTahunAjar as $tahunAjar)
                                        <option value="{{ $tahunAjar->uuid }}" @selected(old('uuid-ref-tahun-ajar') === $tahunAjar->uuid)>{{ $tahunAjar->tahun_ajar }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="jenis-bebas-pinjam" class="col-sm-3 col-form-label">Jenis Bebas Pinjam<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="uuid-ref-jenis-bebas-pinjam" id="jenis-bebas-pinjam">
                                    <option value="">--- Pilih Jenis Bebas Pinjam ---</option>
                                    @foreach($listJenisBebasPinjam as $jenisBebasPinjam)
                                        <option value="{{ $jenisBebasPinjam->uuid }}" @selected(old('uuid-ref-jenis-bebas-pinjam') === $jenisBebasPinjam->uuid)>{{ $jenisBebasPinjam->jenis_bebas_pinjam }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="siswa" class="col-sm-3 col-form-label">Siswa<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control select2" name="uuid-ref-siswa" id="siswa">
                                    <option value="">--- Pilih Siswa/Siswi ---</option>
                                    @if(!is_null($listSiswa))
                                        @foreach($listSiswa as $siswa)
                                            <option value="{{ $siswa->uuid }}" @selected(old('uuid-ref-siswa') === $siswa->uuid)>{{ $siswa->nama_lengkap }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="tanggal-surat" class="col-sm-3 col-form-label">Tanggal Surat Bebas Peminjaman<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="tanggal-surat" name="tanggal-surat-bebas-peminjaman" value="{{ old('tanggal-surat-bebas-peminjaman') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 d-none" id="card-history-peminjaman">
                <div class="card">
                    <div class="card-body">
                        <div class="col-sm-4">
                            <div class="search-box me-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4>History Peminjaman</h4>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered dt-responsive" id="table-history-peminjaman">
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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 d-flex justify-content-between">
                                <a href="{{ route('surat-bebas-pinjam.index') }}" class="btn btn-warning w-md"><i class="mdi mdi-backspace"></i> Kembali</a>
                                <button type="submit" id="button-submit-surat-bebas-pinjam" class="btn btn-primary w-md"><i class="mdi mdi-content-save"></i> Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('custom-script')
    <script>
        $(document).ready(()=>{
            let form = document.getElementById('form-surat-bebas-pinjam');
            let buttonSubmit = document.getElementById('button-submit-surat-bebas-pinjam');
            let messageNotEmpty = 'Wajib diisi';

            let siswa = $("#siswa").val()
            if(siswa !== "")
            {
                $("#card-history-peminjaman").removeClass('d-none')
                let uuidRefSiswa = $("#siswa").val()
                const table = $('#table-history-peminjaman').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    ajax: {
                        url: '/datatables/history-peminjaman',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            'uuid-ref-siswa': uuidRefSiswa
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
            }

            $("#siswa").select2();
            $("#kelas, #kejuruan").on('change',()=>{
                let kelas = $("#kelas").val()
                let kejuruan = $("#kejuruan").val()

                if(kelas !== "" && kejuruan !== "")
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

            $("#tahun-ajar, #kelas, #kejuruan").on('change', ()=>{
                let kelas = $("#kelas").val()
                let kejuruan = $("#kejuruan").val()
                let tahunAjar = $("#tahun-ajar").val()

                if(kelas !== "" && kejuruan !== "" && tahunAjar !== "")
                {
                    axios({
                        url: '/async/siswa-kelas-kejuruan-tahun',
                        method: 'POST',
                        data: {
                            'uuid-ref-kelas': kelas,
                            'uuid-ref-kejuruan': kejuruan,
                            'uuid-ref-tahun-ajar': tahunAjar
                        }
                    }).then((response)=>{
                        let listSiswa = response.data
                        $("#siswa").html('<option value="">--- Pilih Siswa/Siswi ---</option>')
                        listSiswa.forEach((item)=>{
                            $('#siswa').append('<option value="'+item.uuid+'">'+item.nama_lengkap+'</option>')
                        })
                    }).catch((error)=>{
                        console.log(error)
                    })
                }
            });

            $("#siswa").on('change',()=>{
                $("#card-history-peminjaman").removeClass('d-none')
                let uuidRefSiswa = $("#siswa").val()
                const table = $('#table-history-peminjaman').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    ajax: {
                        url: '/datatables/history-peminjaman',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            'uuid-ref-siswa': uuidRefSiswa
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
            });

            buttonSubmit.addEventListener('click', (event) => {
                event.preventDefault();
                validator.validate().then(function (status) {
                    if (status === 'Valid') {
                        buttonSubmit.disabled = true;
                        Swal.fire({
                            text: "Mohon menunggu kami sedang memverifikasi isian form",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(() => {
                            form.submit(); // Submit form after user clicks OK
                        });
                    }
                });
            });

            let validator = FormValidation.formValidation(
                form,
                {
                    fields: {
                        'uuid-ref-kelas': {
                            validators: {
                                notEmpty: { message: messageNotEmpty }
                            }
                        },
                        'uuid-ref-kejuruan': {
                            validators: {
                                notEmpty: { message: messageNotEmpty }
                            }
                        },
                        'uuid-ref-kode-kelas': {
                            validators: {
                                notEmpty: { message: messageNotEmpty }
                            }
                        },
                        'uuid-ref-tahun-ajar': {
                            validators: {
                                notEmpty: { message: messageNotEmpty }
                            }
                        },
                        'uuid-ref-siswa': {
                            validators: {
                                notEmpty: { message: messageNotEmpty }
                            }
                        },
                        'uuid-ref-jenis-bebas-pinjam': {
                            validators: {
                                notEmpty: { message: messageNotEmpty }
                            }
                        },
                        'tanggal-surat-bebas-peminjaman': {
                            validators: {
                                notEmpty: { message: messageNotEmpty },
                                date: {
                                    format: 'YYYY-MM-DD',
                                    min: () => {
                                        const d = new Date();
                                        d.setHours(0, 0, 0, 0);
                                        return d;
                                    },
                                    message: 'Tidak boleh sebelum hari ini',
                                },
                            }
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger({
                            event: 'input blur'
                        }),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: '.fv-row',
                            eleInvalidClass: 'is-invalid',
                            eleValidClass: 'is-valid'
                        })
                    }
                }
            );
        })
    </script>
@endsection