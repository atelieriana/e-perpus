<?php

use App\Http\Controllers\Datatables\BukuPelajaran;
use App\Http\Controllers\Datatables\BukuUmum;

Route::post('/buku-pelajaran', BukuPelajaran::class)
    ->name('buku-pelajaran');
Route::post('/buku-umum', BukuUmum::class)
    ->name('buku-umum');