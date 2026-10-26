<?php

use App\Http\Controllers\Modules\PeminjamanBukuPelajaran\CreatePeminjamanBukuPelajaran;
use App\Http\Controllers\Modules\PeminjamanBukuPelajaran\IndexPeminjamanBukuPelajaran;

Route::get('/', [IndexPeminjamanBukuPelajaran::class, 'index'])
    ->name('index');

#Routing Peminjaman Buku Paket
Route::get('/create', [CreatePeminjamanBukuPelajaran::class, 'index'])
    ->name('create');
Route::post('/submit', [CreatePeminjamanBukuPelajaran::class, 'onSubmit'])
    ->name('create.submit');