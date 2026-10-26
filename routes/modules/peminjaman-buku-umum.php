<?php

use App\Http\Controllers\Modules\PeminjamanBukuUmum\CreatePeminjamanBukuUmum;
use App\Http\Controllers\Modules\PeminjamanBukuUmum\DeletePeminjamanBukuUmum;
use App\Http\Controllers\Modules\PeminjamanBukuUmum\IndexPeminjamanBukuUmum;
use App\Http\Controllers\Modules\PeminjamanBukuUmum\UpdatePeminjamanBukuUmum;

Route::get('/', [IndexPeminjamanBukuUmum::class, 'index'])
    ->name('index');

#Routing Create Penempatan Siswa
Route::get('/create', [CreatePeminjamanBukuUmum::class, 'index'])
    ->name('create');
Route::post('/submit', [CreatePeminjamanBukuUmum::class, 'onSubmit'])
    ->name('create.submit');

#Routing Update Penempatan Siswa
Route::get('/update/{uuid}', [UpdatePeminjamanBukuUmum::class, 'index'])
    ->name('update');
Route::post('/update/submit', [UpdatePeminjamanBukuUmum::class, 'onSubmit'])
    ->name('update.submit');

#Routing Delete Penempatan Siswa
Route::get('/delete/{uuid}', [DeletePeminjamanBukuUmum::class, 'index'])
    ->name('delete');
Route::post('/delete/submit', [DeletePeminjamanBukuUmum::class, 'onSubmit'])
    ->name('delete.submit');