@extends('layouts.landing')
@section('title','Halaman Utama')
@section('content')
    <div class="row text-center mb-5">
        <h1>Cek Ribuan Buku, Jurnal, dan Literatur SMK SAKTI GEMOLONG</h1>
        <p>
            Jelajahi katalog buku, pengecekan bebas pinjam, dan ketersediaan buku seluruh perangkat Anda kapan pun dibutuhkan.
        </p>
    </div>
    <div class="row">
        <div class="card" style="border-radius: 15px">
            <div class="card-body">
                <form action="{{ route('katalog-buku') }}" method="get">
                    <div class="row mb-3">
                        <div class="input-group">
                            <div class="input-group-text">
                                <i class="fa fa-search"></i>
                            </div>
                            <input type="text" class="form-control" name="pencarian" id="pencarian-buku" placeholder="Cari judul buku, penulis, atau penerbit">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-2 text-end">
                            <button type="submit" id="button-cari-siswa-kelas-tahun-ajar" class="btn btn-primary w-md waves-effect waves-light"><i class="mdi mdi-book-search"></i> Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if(isset($listBuku))
        <div class="row">
            <div class="card" style="border-radius: 15px">
                <div class="card-body">
                    <div class="row">
                        <h5 style="color: #34C38F"><i class="fa fa-bookmark"></i> Koleksi Buku Terbaru</h5>
                    </div>
                    <div class="row">
                        @foreach($listBuku as $buku)
                            <div class="card" style="background: #222736; border-radius: 15px; margin-bottom: 1em">
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <img src="{{ asset('images/palceholder.jpg') }}" alt="cover-buku" class="img-fluid"/>
                                            </div>
                                            <div class="col-md-11">
                                                <h5>{{ $buku->judul }}</h5>
                                                <p>{{ $buku->penulis }}</p>
                                                <p>{{ $buku->tahun_terbit }}</p>
                                                <p>{{ $buku->halaman }} halaman</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end mt-3">
            {{ $listBuku->links('vendor.pagination.bootstrap-4') }}
        </div>
    @endif
@endsection