<?php

use App\Http\Controllers\Modules\BukuPaket\CreateBukuPaket;
use App\Http\Controllers\Modules\BukuPaket\DeleteBukuPaket;
use App\Http\Controllers\Modules\BukuPaket\IndexBukuPaket;
use App\Http\Controllers\Modules\BukuPaket\UpdateBukuPaket;
use Illuminate\Support\Facades\Route;

#Routing Index Buku Pelajaran
Route::get('/', [IndexBukuPaket::class, 'index'])
    ->name('index');

#Routing Create Buku Pelajaran
Route::get('/create', [CreateBukuPaket::class, 'index'])
    ->name('create');
Route::post('/create/submit',[CreateBukuPaket::class, 'onSubmit'])
    ->name('create.submit');

#Routing Update Buku Pelajaran
Route::get('/update/{uuid}', [UpdateBukuPaket::class, 'index'])
    ->name('update');
Route::post('/update/submit', [UpdateBukuPaket::class, 'onSubmit'])
    ->name('update.submit');

#Routing Delete Buku Pelajaran
Route::get('/delete/{uuid}', [DeleteBukuPaket::class, 'index'])
    ->name('delete');
Route::post('/delete/submit', [DeleteBukuPaket::class, 'onSubmit'])
    ->name('delete.submit');