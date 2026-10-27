@extends('layouts.backoffice')
@section('title','Peminjaman Buku Umum')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Peminjaman Buku Umum</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('peminjaman-buku-umum.index') }}">Peminjaman Buku Umum</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
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
                    <div class="col-sm-4">
                        <div class="search-box me-2 mb-2 d-inline-block">
                            <div class="position-relative">
                                <h4>Peminjaman Buku Umum</h4>
                            </div>
                        </div>
                    </div>
                    <form id="form-peminjaman-buku-umum" method="post" action="{{ route('peminjaman-buku-umum.create.submit') }}">
                        @csrf
                        <div class="fv-row row mb-4">
                            <label for="kelas" class="col-sm-3 col-form-label">Kelas<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="select2 form-control" id="kelas" name="uuid-ref-kelas">
                                    <option value="">--- Pilih Kelas ---</option>
                                    @foreach($listKelas as $kelas)
                                        <option value="{{ $kelas->uuid }}" @selected(old('uuid-ref-kelas') === $kelas->uuid)>{{ $kelas->kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="fv-row row mb-4">
                            <label for="kejuruan" class="col-sm-3 col-form-label">Kejuruan<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control select2" id="kejuruan" name="uuid-ref-kejuruan">
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
                                <select class="form-control select2" id="kode-kelas" name="uuid-ref-kode-kelas">
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
                            <label for="siswa" class="col-sm-3 col-form-label">Nama Siswa/Siswi<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control select2" id="siswa" name="uuid-ref-siswa">
                                    <option value="">--- Pilih Siswa ---</option>
                                    @if(!is_null($listSiswa))
                                        @foreach($listSiswa as $siswa)
                                            <option value="{{ $siswa->uuid }}" @selected(old('uuid-ref-siswa') === $siswa->uuid)>{{ $siswa->nama_lengkap }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="fv-row row mb-4">
                            <label for="buku-1" class="col-sm-3 col-form-label">Buku 1<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control select2" id="buku-1" data-buku="1" name="uuid-ref-buku[]">
                                    <option value="">--- Pilih Buku ---</option>
                                    @foreach($listBuku as $buku)
                                        <option value="{{ $buku->uuid }}">{{ $buku->judul }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="fv-row row mb-4">
                            <label for="buku-2" class="col-sm-3 col-form-label">Buku 2</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" id="buku-2" data-buku="2" name="uuid-ref-buku[]">
                                    <option value="">--- Pilih Buku ---</option>
                                    @foreach($listBuku as $buku)
                                        <option value="{{ $buku->uuid }}">{{ $buku->judul }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="fv-row row mb-4">
                            <label for="buku-3" class="col-sm-3 col-form-label">Buku 3</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" id="buku-3" data-buku="3" name="uuid-ref-buku[]">
                                    <option value="">--- Pilih Buku ---</option>
                                    @foreach($listBuku as $buku)
                                        <option value="{{ $buku->uuid }}">{{ $buku->judul }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="fv-row row mb-4">
                            <label for="buku-1" class="col-sm-3 col-form-label">Tanggal Pinjam<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="tanggal-pinjam" value="{{ old('tanggal-pinjam') }}"/>
                            </div>
                        </div>
                        <div class="fv-row row mb-4">
                            <label for="buku-1" class="col-sm-3 col-form-label">Tanggal Akhir Pinjam<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="tanggal-terakhir-pinjam" value="{{ old('tanggal-terakhir-pinjam') }}"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 d-flex justify-content-between">
                                <a href="{{ route('peminjaman-buku-umum.index') }}" class="btn btn-warning w-md waves-effect waves-light"><i class="mdi mdi-backspace"></i> Kembali</a>
                                <button type="submit" id="button-submit-peminjaman-buku-umum" class="btn btn-primary w-md waves-effect waves-light"><i class="mdi mdi-content-save"></i> Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script type="text/javascript">
        $(document).ready(function(){
            let form = document.getElementById('form-peminjaman-buku-umum');
            let buttonSubmit = document.getElementById('button-submit-peminjaman-buku-umum');
            let messageNotEmpty = 'Wajib diisi';

            $("#kelas").select2();
            $("#kejuruan").select2();
            $("#kode-kelas").select2();
            $("#siswa").select2();
            $("#buku-1").select2();
            $("#buku-2").select2();
            $("#buku-3").select2();

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

            $("#kode-kelas").on('change',(e)=>{
                let kelas = $("#kelas").val()
                let kejuruan = $("#kejuruan").val()
                axios({
                    url: '/async/siswa-kelas-kejuruan',
                    method: 'POST',
                    data: {
                        'uuid-ref-kelas': kelas,
                        'uuid-ref-kejuruan': kejuruan
                    }
                }).then((response)=>{
                    let listSiswa = response.data
                    $("#siswa").html('<option value="">--- Pilih Siswa ---</option>')
                    listSiswa.forEach((item)=>{
                        $('#siswa').append('<option value="'+item.uuid+'">'+item.nama_lengkap+'</option>')
                    })
                }).catch((error)=>{
                    console.log(error)
                })
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
                        'uuid-ref-siswa': {
                            validators: {
                                notEmpty: { message: messageNotEmpty }
                            }
                        },
                        'tanggal-pinjam': {
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
                        'tanggal-terakhir-pinjam': {
                            validators: {
                                notEmpty: { message: messageNotEmpty },
                                date: {
                                    format: 'YYYY-MM-DD',
                                    min: () => {
                                        const d = new Date();
                                        d.setHours(0, 0, 0, 0);
                                        return d;
                                    },
                                    max: () => {
                                        const d = new Date();
                                        d.setHours(0, 0, 0, 0);
                                        d.setDate(d.getDate() + 14);
                                        return d;
                                    },
                                    message: 'Tidak boleh lebih dari 2 minggu',
                                },
                            }
                        },
                        book1: {
                            selector: '[name="uuid-ref-buku[]"][data-buku="1"]',
                            validators: {
                                notEmpty: { message: messageNotEmpty }
                            }
                        },
                        book2: {
                            selector: '[name="uuid-ref-buku[]"][data-buku="2"]',
                            validators: {
                                stringLength: { min: 3, message: 'At least 3 characters' }
                            }
                        },
                        book3: {
                            selector: '[name="uuid-ref-buku[]"][data-buku="3"]',
                            validators: {
                                stringLength: { min: 3, message: 'At least 3 characters' }
                            }
                        }
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
        });
    </script>
@endsection
