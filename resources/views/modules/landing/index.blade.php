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
                <div class="row mb-3">
                    <div class="input-group">
                        <div class="input-group-text">
                            <i class="fa fa-search"></i>
                        </div>
                        <input type="text" class="form-control" name="pencarian-buku" id="pencarian-buku" placeholder="Cari judul buku, penulis, atau penerbit">
                    </div>
                </div>
                <div class="row">
                    <h5 style="color: #34C38F"><i class="fa fa-bookmark"></i> Koleksi Buku Terbaru</h5>
                </div>
                <div class="row">
                    @for($i = 0; $i < 4; $i++)
                        <div class="card" style="background: #222736; border-radius: 15px; margin-bottom: 1em">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <img src="{{ asset('images/palceholder.jpg') }}" alt="cover-buku" class="img-fluid"/>
                                        </div>
                                        <div class="col-md-11">
                                            <h5>Judul Buku</h5>
                                            <p>Pengarang</p>
                                            <p>Tahun Terbit</p>
                                            <p>Jumlah Halaman</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <p style="color: #34C38F; margin-bottom: 1em !important;"><i class="fa fa-expand"></i> Eksplorasi Tematik</p>
    </div>
    <div class="row">
        <h3>Buku Bacaan Terfavorit</h3>
        <p>Buku bacaan yang paling sering dipinjam oleh siswa</p>
        <div class="row">
            <div class="col-md-6">
                <div class="card" style="border-radius: 15px">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="{{ asset('images/palceholder.jpg') }}" alt="cover-buku" class="img-fluid"/>
                            </div>
                            <div class="col-md-10">
                                <p>Judul</p>
                                <p>Pengarang</p>
                                <p>Jumlah Peminjaman</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card" style="border-radius: 15px">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="{{ asset('images/palceholder.jpg') }}" alt="cover-buku" class="img-fluid"/>
                            </div>
                            <div class="col-md-10">
                                <p>Judul</p>
                                <p>Pengarang</p>
                                <p>Jumlah Peminjaman</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card" style="border-radius: 15px">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="{{ asset('images/palceholder.jpg') }}" alt="cover-buku" class="img-fluid"/>
                            </div>
                            <div class="col-md-10">
                                <p>Judul</p>
                                <p>Pengarang</p>
                                <p>Jumlah Peminjaman</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card" style="border-radius: 15px">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="{{ asset('images/palceholder.jpg') }}" alt="cover-buku" class="img-fluid"/>
                            </div>
                            <div class="col-md-10">
                                <p>Judul</p>
                                <p>Pengarang</p>
                                <p>Jumlah Peminjaman</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <h3>Jurnal Pilihan Utama</h3>
        <p>Jurnal yang paling sering dijadikan referensi</p>
        <div class="row">
            <div class="col-md-6">
                <div class="card" style="border-radius: 15px">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="{{ asset('images/palceholder.jpg') }}" alt="cover-buku" class="img-fluid"/>
                            </div>
                            <div class="col-md-10">
                                <p>Judul</p>
                                <p>Penulis</p>
                                <p>Tahun Terbit</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card" style="border-radius: 15px">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="{{ asset('images/palceholder.jpg') }}" alt="cover-buku" class="img-fluid"/>
                            </div>
                            <div class="col-md-10">
                                <p>Judul</p>
                                <p>Penulis</p>
                                <p>Tahun Terbit</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card" style="border-radius: 15px">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="{{ asset('images/palceholder.jpg') }}" alt="cover-buku" class="img-fluid"/>
                            </div>
                            <div class="col-md-10">
                                <p>Judul</p>
                                <p>Penulis</p>
                                <p>Tahun Terbit</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card" style="border-radius: 15px">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="{{ asset('images/palceholder.jpg') }}" alt="cover-buku" class="img-fluid"/>
                            </div>
                            <div class="col-md-10">
                                <p>Judul</p>
                                <p>Penulis</p>
                                <p>Tahun Terbit</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <p style="color: #34C38F; margin-bottom: 1em !important;"><i class="fa fa-check-circle"></i> Fitur Utama</p>
    </div>
    <div class="row">
        <div class="card" style="border-radius: 15px">
            <div class="card-body">
                <div class="card" style="border-radius: 15px; width: fit-content; background: #222736">
                    <div class="card-body">
                        <img src="{{ asset('icon/library.png') }}" alt="multi-device">
                    </div>
                </div>
                <h3>Dengan koleksi lebih dari 1.000 buku dan jurnal</h3>
                <p>Mulai dari buku pelajaran, novel, jurnal, dan berbagai karya ilmiah</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card" style="border-radius: 15px">
            <div class="card-body">
                <div class="card" style="border-radius: 15px; width: fit-content; background: #222736">
                    <div class="card-body">
                        <img src="{{ asset('icon/search.png') }}" alt="multi-device">
                    </div>
                </div>
                <h3>History Peminjaman Buku</h3>
                <p>Siswa dapat melakukan pengecekan secara mandiri terkait buku pelajaran ataupun buku umum lainnya yang sedang dipinjam</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card" style="border-radius: 15px">
            <div class="card-body">
                <div class="card" style="border-radius: 15px; width: fit-content; background: #222736">
                    <div class="card-body">
                        <img src="{{ asset('icon/device.png') }}" alt="multi-device">
                    </div>
                </div>
                <h3>Akses Multi Perangkat</h3>
                <p>Aplikasi dapat diakses dengan berbagai jenis perangkat</p>
            </div>
        </div>
    </div>
@endsection
