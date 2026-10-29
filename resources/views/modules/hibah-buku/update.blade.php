@extends('layouts.backoffice')
@section('title','Hibah Buku')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Hibah Buku</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('hibah-buku.index') }}">Hibah</a></li>
                        <li class="breadcrumb-item active">Buat</li>
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
                                <h4>Tambah Hibah Buku</h4>
                            </div>
                        </div>
                    </div>
                    <form id="form-buku-umum" method="post" action="{{ route('hibah-buku.update.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="uuid-trans-hibah" value="{{ $dataBukuHibah->uuid }}"/>
                        <input type="hidden" name="uuid-ref-buku" value="{{ $dataBukuHibah->ref_buku->uuid }}"/>
                        <div class="fv-row row mb-4">
                            <label for="kejuruan" class="col-sm-3 col-form-label">Kejuruan<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control select2" id="kejuruan" name="kejuruan">
                                    <option value="">--- Pilih Kejuruan ---</option>
                                    @foreach($listKejuruan as $kejuruan)
                                        <option value="{{ $kejuruan->uuid }}" @selected((old('kejuruan') ? old('kejuruan') : $dataBukuHibah->ref_siswa->trans_penempatan_latest->ref_kode_kelas->ref_kejuruan->uuid) === $kejuruan->uuid)>{{ $kejuruan->kejuruan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="kode-kelas" class="col-sm-3 col-form-label">Kode Kelas<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control select2" id="kode-kelas" name="kode-kelas">
                                    <option value="">--- Pilih Kode Kelas ---</option>
                                    @if(!is_null($listKodeKelas))
                                        @foreach($listKodeKelas as $kodeKelas)
                                            <option value="{{ $kodeKelas->uuid }}" @selected((old('kode-kelas') ? old('kode-kelas') : $dataBukuHibah->ref_siswa->trans_penempatan_latest->ref_kode_kelas->uuid) === $kodeKelas->uuid)>{{ $kodeKelas->kode_kelas }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="tahun-ajar" class="col-sm-3 col-form-label">Tahun Ajar<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control select2" id="tahun-ajar" name="tahun-ajar">
                                    <option value="">--- Pilih Tahun Ajar ---</option>
                                    @foreach($listTahunAjar as $tahunAjar)
                                        <option value="{{ $tahunAjar->uuid }}" @selected((old('tahun-ajar') ? old('tahun-ajar') : $dataBukuHibah->ref_siswa->trans_penempatan_latest->ref_tahun_ajar->uuid ))>{{ $tahunAjar->tahun_ajar }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="siswa" class="col-sm-3 col-form-label">Nama Siswa/Siswi<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control select2" id="siswa" name="uuid-ref-siswa">
                                    <option value="">--- Pilih Siswa/Siswi ---</option>
                                    @if(!is_null($listSiswa))
                                        @foreach($listSiswa as $siswa)
                                            <option value="{{ $siswa->uuid }}" @selected((old('uuid-ref-siswa') ? old('uuid-ref-siswa') : $dataBukuHibah->ref_siswa->uuid) === $siswa->uuid)> {{ $siswa->nama_lengkap }} </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="judul" class="col-sm-3 col-form-label">Judul Buku<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="judul" name="judul" value="{{ (old('judul') ?? $dataBukuHibah->ref_buku->judul) }}" placeholder="Masukkan judul buku">
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="kota-terbit" class="col-sm-3 col-form-label">Kota Terbit<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kota-terbit" name="kota-terbit" value="{{ (old('kota-terbit') ?? $dataBukuHibah->ref_buku->kota_terbit) }}" placeholder="Masukkan kota terbit">
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="penerbit" class="col-sm-3 col-form-label">Penerbit<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{ (old('penerbit') ?? $dataBukuHibah->ref_buku->penerbit) }}" placeholder="Masukkan penerbit">
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="penulis" class="col-sm-3 col-form-label">Penulis<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="penulis" name="penulis" value="{{ (old('penulis') ?? $dataBukuHibah->ref_buku->penulis) }}" placeholder="Masukkan penulis">
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="tahun-terbit" class="col-sm-3 col-form-label">Tahun Terbit<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="tahun-terbit" name="tahun-terbit" value="{{ (old('tahun-terbit') ?? $dataBukuHibah->ref_buku->tahun_terbit) }}" placeholder="Masukkan tahun terbit">
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="isbn" class="col-sm-3 col-form-label">ISBN<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="isbn" name="isbn" value="{{ (old('isbn') ?? $dataBukuHibah->ref_buku->isbn) }}" placeholder="Masukkan ISBN">
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="deskripsi-fisik" class="col-sm-3 col-form-label">Deskripsi Fisik<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="deskripsi-fisik" name="deskripsi-fisik" value="{{ (old('deskripsi-fisik') ?? $dataBukuHibah->ref_buku->deskripsi_fisik) }}" placeholder="Masukkan deskripsi fisik">
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="halaman" class="col-sm-3 col-form-label">Jumlah Halaman<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="halaman" name="halaman" value="{{ (old('halaman') ?? $dataBukuHibah->ref_buku->halaman) }}" placeholder="Masukkan jumlah halaman">
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="jumlah-buku" class="col-sm-3 col-form-label">Jumlah Buku<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="jumlah-buku" name="jumlah-buku" value="{{ (old('jumlah-buku') ?? $dataBukuHibah->ref_buku->jumlah_buku) }}" placeholder="Masukkan jumlah buku">
                            </div>
                        </div>

                        <div class="fv-row row mb-4">
                            <label for="cover-buku" class="col-sm-3 col-form-label">Cover Buku</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="file" id="cover-buku" name="cover-buku">
                                @if(!is_null($dataBukuHibah->ref_buku->file_cover))
                                    <p class="mt-1">Cover buku saat ini</p>
                                    <img src="{{ getFile($dataBukuHibah->ref_buku->file_cover) }}" alt="cover-buku" class="img-fluid" width="20%">
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 d-flex justify-content-between">
                                <a href="{{ route('hibah-buku.index') }}" class="btn btn-warning w-md"><i class="mdi mdi-backspace"></i> Kembali</a>
                                <button type="submit" id="button-submit-buku-umum" class="btn btn-primary w-md"><i class="mdi mdi-content-save"></i> Submit</button>
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
        document.addEventListener("DOMContentLoaded", function () {
            $("#kejuruan").select2();
            $("#kode-kelas").select2();
            $("#tahun-ajar").select2();
            $("#siswa").select2();

            const date = new Date()
            let form = document.getElementById('form-buku-umum');
            let buttonSubmit = document.getElementById('button-submit-buku-umum');
            let messageNotEmpty = 'Wajib diisi';
            let messageStringMax = 'Hanya dapat diisi 255 karakter'
            let currentYear = date.getFullYear()

            $("#kejuruan, #kelas").on('change',()=>{
                let kelas = $("#kelas").val()
                let kejuruan = $("#kejuruan").val()

                if (kelas !== "" && kejuruan !== "")
                {
                    axios({
                        url: '/async/kode-kelas',
                        method: 'POST',
                        data: {
                            'uuid-kelas': 'a4f8318f-3045-41a6-9101-ab2f2699b169',
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

            $("#tahun-ajar").on('change',(e)=>{
                let kejuruan = $("#kejuruan").val()
                let tahunAjar = $("#tahun-ajar").val()
                axios({
                    url: '/async/siswa-kelas-kejuruan-tahun',
                    method: 'POST',
                    data: {
                        'uuid-ref-kelas': 'a4f8318f-3045-41a6-9101-ab2f2699b169',
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
                        'kejuruan': {
                            validators: {
                                notEmpty: { message: messageNotEmpty }
                            }
                        },
                        'kode-kelas': {
                            validators: {
                                notEmpty: { message: messageNotEmpty }
                            }
                        },
                        'tahun-ajar': {
                            validators: {
                                notEmpty: { message: messageNotEmpty }
                            }
                        },
                        'uuid-ref-siswa': {
                            validators: {
                                notEmpty: { message: messageNotEmpty }
                            }
                        },
                        'judul': {
                            validators: {
                                notEmpty: { message: messageNotEmpty },
                                stringLength: { max: 255, message: messageStringMax }
                            },
                        },
                        'kota-terbit': {
                            validators: {
                                notEmpty: { message: messageNotEmpty },
                                stringLength: { max: 255, message: messageStringMax },
                                regexp: {
                                    regexp: "^[a-zA-Z ]+$",
                                    message: "Kota terbit hanya boleh huruf"
                                }
                            },
                        },
                        'penerbit': {
                            validators: {
                                notEmpty: { message: messageNotEmpty },
                                stringLength: { max: 255, message: messageStringMax }
                            }
                        },
                        'penulis': {
                            validators: {
                                notEmpty: { message: messageNotEmpty },
                                stringLength: { max: 255, message: messageStringMax },
                            }
                        },
                        'tahun-terbit': {
                            validators: {
                                notEmpty: { message: messageNotEmpty },
                                digits: { message: 'Hanya bisa berisikan angka' },
                                stringLength: {
                                    min: 4,
                                    max: 4,
                                    message: 'Hanya bisa diisikan empat digit'
                                },
                                between: {
                                    min: 1000,
                                    max: currentYear,
                                    message: 'Tahun terbit harus antara 1000 dan ' + currentYear
                                }
                            }
                        },
                        'isbn': {
                            validators: {
                                notEmpty: { message: messageNotEmpty },
                                isbn: { message: 'Format ISBN tidak valid (ISBN-10 atau ISBN-13)' }
                            }
                        },
                        'deskripsi-fisik': {
                            validators: {
                                notEmpty: { message: messageNotEmpty },
                                stringLength: { max: 255, message: messageStringMax }
                            }
                        },
                        'halaman': {
                            validators: {
                                notEmpty: { message: messageNotEmpty },
                                digits: { message: 'Hanya bisa berisikan angka' },
                                greaterThan: {
                                    min: 1,
                                    message: 'Jumlah halaman minimal 1'
                                }
                            }
                        },
                        'jumlah-buku': {
                            validators: {
                                notEmpty: { message: messageNotEmpty },
                                digits: { message: 'Hanya bisa berisikan angka' },
                                greaterThan: {
                                    min: 1,
                                    message: 'Jumlah buku minimal 1'
                                }
                            }
                        },
                        'cover-buku': {
                            validators: {
                                file: {
                                    extension: 'jpg,jpeg,png,webp',
                                    type: 'image/jpeg,image/png,image/webp',
                                    maxSize: 2 * 1024 * 1024, // 2 MB
                                    message: 'File harus berupa gambar (jpg, jpeg, png, webp) dengan ukuran maksimal 2 MB'
                                }
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