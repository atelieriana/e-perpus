<?php

use App\Http\Controllers\Datatables\BukuPelajaran;
use App\Http\Controllers\Datatables\BukuUmum;
use App\Http\Controllers\Datatables\Kejuruan;
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