<?php

use App\Http\Controllers\Datatables\BukuPaket;
use App\Http\Controllers\Datatables\BukuPelajaran;
use App\Http\Controllers\Datatables\BukuUmum;
use App\Http\Controllers\Datatables\Kejuruan;
use App\Http\Controllers\Datatables\KodeKelas;
use App\Http\Controllers\Datatables\PenempatanSiswa;
use App\Http\Controllers\Datatables\Siswa;
use App\Http\Controllers\Datatables\TahunAjar;
use Illuminate\Support\Facades\Route;

Route::post('/buku-pelajaran', BukuPelajaran::class)
    ->name('buku-pelajaran');
Route::post('/buku-umum', BukuUmum::class)
    ->name('buku-umum');
Route::post('/siswa', Siswa::class)
    ->name('siswa');
Route::post('/kejuruan', Kejuruan::class)
    ->name('kejuruan');
Route::post('/tahun-ajar', TahunAjar::class)
    ->name('tahun-ajar');
Route::post('/kode-kelas', KodeKelas::class)
    ->name('kode-kelas');
Route::post('/buku-paket', BukuPaket::class)
    ->name('buku-paket');
Route::post('/penempatan-siswa', PenempatanSiswa::class)
    ->name('penempatan-siswa');