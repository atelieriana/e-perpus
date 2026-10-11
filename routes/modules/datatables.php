<?php

use App\Http\Controllers\Datatables\BukuPelajaran;
use App\Http\Controllers\Datatables\BukuUmum;
use App\Http\Controllers\Datatables\Siswa;
use Illuminate\Support\Facades\Route;

Route::post('/buku-pelajaran', BukuPelajaran::class)
    ->name('buku-pelajaran');
Route::post('/buku-umum', BukuUmum::class)
    ->name('buku-umum');
Route::post('/siswa', Siswa::class)
    ->name('siswa');