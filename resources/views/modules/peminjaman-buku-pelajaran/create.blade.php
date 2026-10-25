@extends('layouts.backoffice')
@section('title','Peminjama Buku Paket')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Peminjaman Buku</h4>
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
                    <form method="get" action="{{ route('peminjaman-buku-pelajaran.create') }}">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <select class="form-control select2" id="kelas" name="uuid-ref-kelas" required>
                                    <option value="">--- Pilih Kelas ---</option>
                                    @foreach($listKelas as $kelas)
                                        <option value="{{ $kelas->uuid }}" @selected($kelas->uuid === request()->query('uuid-ref-kelas'))>{{ $kelas->kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="kejuruan" class="form-label">Kejuruan</label>
                                <select class="form-control select2" id="kejuruan" name="uuid-ref-kejuruan" required>
                                    <option value="">--- Pilih Kejuruan ---</option>
                                    @foreach($listKejuruan as $kejuruan)
                                        <option value="{{ $kejuruan->uuid }}" @selected($kejuruan->uuid === request()->query('uuid-ref-kejuruan'))>{{ $kejuruan->kejuruan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="kode-kelas" class="form-label">Kode Kelas</label>
                                <select class="form-control select2" id="kode-kelas" name="uuid-ref-kode-kelas" required>
                                    <option value="">--- Pilih Kode Kelas ---</option>
                                    @foreach($listKodeKelas as $kodeKelas)
                                        <option value="{{ $kodeKelas->uuid }}" @selected($kodeKelas->uuid === request()->query('uuid-ref-kode-kelas'))>{{ $kodeKelas->kode_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="tahun-ajar" class="form-label">Tahun Ajar</label>
                                <select class="form-control select2" id="tahun-ajar" name="uuid-ref-tahun-ajar" required>
                                    <option value="">--- Pilih Tahun Ajar ---</option>
                                    @foreach($listTahunAjar as $tahunAjar)
                                        <option value="{{ $tahunAjar->uuid }}" @selected($tahunAjar->uuid === request()->query('uuid-ref-tahun-ajar'))>{{ $tahunAjar->tahun_ajar }} ({{ getIndonesianDate($tahunAjar->tanggal_mulai) . ' s.d. '. getIndonesianDate($tahunAjar->tanggal_akhir) }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-3 text-end">
                                <button type="submit" id="button-cari-kelas" class="btn btn-primary w-md waves-effect waves-light"><i class="mdi mdi-book-search"></i> Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('peminjaman-buku-pelajaran.create.submit') }}">
                    <input type="hidden" name="uuid-ref-kelas" value="{{ request()->input('uuid-ref-kelas') }}"/>
                    <input type="hidden" name="uuid-ref-kejuruan" value="{{ request()->input('uuid-ref-kejuruan') }}"/>
                    <input type="hidden" name="uuid-ref-kode-kelas" value="{{ request()->input('uuid-ref-kode-kelas') }}"/>
                    <input type="hidden" name="uuid-ref-tahun-ajar" value="{{ request()->input('uuid-ref-tahun-ajar') }}"/>
                    <div class="row">
                        @foreach($listSiswa as $siswa)
                            <div class="col-xl-12 mb-2">
                                <div class="accordion" id="accordionExample{{$loop->iteration}}">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$loop->iteration}}" aria-expanded="false" aria-controls="collapseTwo">
                                                {{ $siswa->nama_lengkap }}
                                            </button>
                                        </h2>
                                        <div id="collapse{{$loop->iteration}}" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample{{$loop->iteration}}">
                                            <div class="accordion-body">
                                                @foreach($listBukuPaket as $bukuPaket)
                                                    <div class="row mb-2">
                                                        <div class="col-md-4">{{ $bukuPaket->judul }}</div>
                                                        <div class="col-md-8">
                                                            <select class="form-control" name="buku-paket[{{ $siswa->uuid }}][{{$bukuPaket->uuid}}][]">
                                                                <option value="">--- Pilih Status ---</option>
                                                                @foreach($listStatusPeminjaman as $statusPeminjaman)
                                                                    <option value="{{ $statusPeminjaman->uuid }}"
                                                                            @selected(old('buku-paket.'.$siswa->uuid.'.'.$bukuPaket->uuid.'.0') === $statusPeminjaman->uuid)
                                                                            @if(in_array($statusPeminjaman->uuid, data_get($listPeminjaman, "*.{$siswa->uuid}.{$bukuPaket->uuid}.0")))
                                                                                selected
                                                                            @endif
                                                                    >
                                                                        {{ $statusPeminjaman->status_peminjaman }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-3 text-end">
                            <button type="submit" id="button-cari-kelas" class="btn btn-primary w-md waves-effect waves-light"><i class="mdi mdi-content-save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script>
        $(document).ready(()=>{
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
        })
    </script>
@endsection