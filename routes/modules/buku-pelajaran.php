<?php

use App\Http\Controllers\Modules\BukuPelajaran\CreateBukuPelajaran;
use App\Http\Controllers\Modules\BukuPelajaran\DeleteBukuPelajaran;
use App\Http\Controllers\Modules\BukuPelajaran\IndexBukuPelajaran;
use App\Http\Controllers\Modules\BukuPelajaran\UpdateBukuPelajaran;
use Illuminate\Support\Facades\Route;

#Routing Index Buku Pelajaran
Route::get('/', [IndexBukuPelajaran::class, 'index'])
    ->name('index');

#Routing Create Buku Pelajaran
Route::get('/create', [CreateBukuPelajaran::class, 'index'])
    ->name('create');
Route::post('/create/submit',[CreateBukuPelajaran::class, 'onSubmit'])
    ->name('create.submit');

#Routing Update Buku Pelajaran
Route::get('/update/{uuid}', [UpdateBukuPelajaran::class, 'index'])
    ->name('update');
Route::post('/update/submit', [UpdateBukuPelajaran::class, 'onSubmit'])
    ->name('update.submit');

#Routing Delete Buku Pelajaran
Route::get('/delete/{uuid}', [DeleteBukuPelajaran::class, 'index'])
    ->name('delete');
Route::post('/delete/submit', [DeleteBukuPelajaran::class, 'onSubmit'])
    ->name('delete.submit');