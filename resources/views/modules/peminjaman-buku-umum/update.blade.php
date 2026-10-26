@extends('layouts.backoffice')
@section('title','Peminjaman Buku Umum')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Pengembalian/Perpanjangan Buku Umum</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('peminjaman-buku-umum.index') }}">Peminjaman Buku Umum</a></li>
                        <li class="breadcrumb-item active">Pengembalian/Perpanjangan</li>
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
                                <h4>Pengembalian/Perpanjangan Peminjaman</h4>
                            </div>
                        </div>
                    </div>
                    <form id="form-peminjaman-buku-umum" method="post" action="{{ route('peminjaman-buku-umum.create.submit') }}">
                        @csrf
                        <div class="fv-row row mb-4">
                            <label for="siswa" class="col-sm-3 col-form-label">Nama Siswa/Siswi<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nama" value="{{ $dataPeminjaman[0]->nama_lengkap }}" readonly>
                            </div>
                        </div>
                        @foreach($dataPeminjaman as $peminjaman)
                            <input type="hidden" name="uuid-trans-peminjaman[]" value="{{ $peminjaman->uuid }}"/>
                            <div class="fv-row row mb-4">
                                <label for="siswa" class="col-sm-3 col-form-label">Buku {{ $loop->iteration }}<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nama" value="{{ $peminjaman->judul }}" readonly>
                                </div>
                            </div>
                            <div class="fv-row row mb-4">
                                <label for="status-peminjaman" class="col-sm-3 col-form-label">Status Peminjaman<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" id="status-peminjaman">
                                        <option value="">--- Pilih Status ---</option>
                                        @foreach($listStatusPeminjaman as $statusPeminjaman)
                                            <option value="{{ $statusPeminjaman->peminjaman }}" @selected($statusPeminjaman->uuid === $peminjaman->uuid_ref_status_peminjaman)>{{ $statusPeminjaman->status_peminjaman }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="fv-row row mb-4">
                                <label for="status-peminjaman" class="col-sm-3 col-form-label">Perpanjangan</label>
                                <div class="col-sm-9">
                                    <input type="date" name="perpanjangan-pinjam[]" class="form-control"/>
                                </div>
                            </div>
                            <hr/>
                        @endforeach
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
