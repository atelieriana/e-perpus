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

//#Routing Update Penempatan Siswa
//Route::get('/update/{uuid}', [UpdatePenempatanSiswa::class, 'index'])
//    ->name('update');
//Route::post('/update/submit', [UpdatePenempatanSiswa::class, 'onSubmit'])
//    ->name('update.submit');
//
//#Routing Delete Penempatan Siswa
//Route::get('/delete/{uuid}', [DeletePenempatanSiswa::class, 'index'])
//    ->name('delete');
//Route::post('/delete/submit', [DeletePenempatanSiswa::class, 'onSubmit'])
//    ->name('delete.submit');