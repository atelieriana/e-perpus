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
                    <form id="form-peminjaman-buku-umum" method="post" action="{{ route('peminjaman-buku-umum.delete.submit') }}">
                        @csrf
                        <input type="hidden" name="uuid-ref-siswa" value="{{ $dataPeminjaman[0]->uuid_ref_siswa }}"/>
                        <input type="hidden" name="unique-code" value="{{ base64_encode($dataPeminjaman[0]->tanggal_mulai_pinjam) }}"/>
                        <div class="fv-row row mb-4">
                            <label for="siswa" class="col-sm-3 col-form-label">Nama Siswa/Siswi<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nama" value="{{ $dataPeminjaman[0]->nama_lengkap }}" readonly>
                            </div>
                        </div>
                        @foreach($dataPeminjaman as $peminjaman)
                            <input type="hidden" name="uuid-trans-peminjaman[]" value="{{ $peminjaman->uuid_trans_peminjaman_buku }}"/>
                            <div class="fv-row row mb-4">
                                <label for="siswa" class="col-sm-3 col-form-label">Buku {{ $loop->iteration }}<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ $peminjaman->judul }}" readonly>
                                </div>
                            </div>
                            <hr/>
                        @endforeach
                        <div class="row">
                            <div class="col-sm-12 d-flex justify-content-between">
                                <a href="{{ route('peminjaman-buku-umum.index') }}" class="btn btn-warning w-md waves-effect waves-light"><i class="mdi mdi-backspace"></i> Kembali</a>
                                <button type="submit" id="button-submit-peminjaman-buku-umum" class="btn btn-danger w-md waves-effect waves-light"><i class="mdi mdi-content-save"></i> Hapus</button>
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
                        status1: {
                            selector: '[name="uuid-ref-status-peminjaman[]"][data-status-peminjaman="1"]',
                            validators: {
                                notEmpty: { message: messageNotEmpty }
                            }
                        },
                        status2: {
                            selector: '[name="uuid-ref-status-peminjaman[]"][data-status-peminjaman="2"]',
                            validators: {
                                notEmpty: { message: messageNotEmpty }
                            }
                        },
                        status3: {
                            selector: '[name="uuid-ref-status-peminjaman[]"][data-status-peminjaman="3"]',
                            validators: {
                                notEmpty: { message: messageNotEmpty }
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
