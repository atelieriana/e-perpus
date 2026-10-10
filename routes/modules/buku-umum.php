<?php

use App\Http\Controllers\Modules\BukuUmum\CreateBukuUmum;
use App\Http\Controllers\Modules\BukuUmum\DeleteBukuUmum;
use App\Http\Controllers\Modules\BukuUmum\IndexBukuUmum;
use App\Http\Controllers\Modules\BukuUmum\UpdateBukuUmum;

#Index Buku Umum Route
Route::get('/', [IndexBukuUmum::class, 'index'])
    ->name('index');

#Create Buku Umum Route
Route::get('/create', [CreateBukuUmum::class, 'index'])
    ->name('create');
Route::post('/create/submit',[CreateBukuUmum::class, 'onSubmit'])
    ->name('create.submit');

#Update Buku Umum Route
Route::get('/update/{uuid}', [UpdateBukuUmum::class, 'index'])
    ->name('update');
Route::post('/update/submit', [UpdateBukuUmum::class, 'onSubmit'])
    ->name('update.submit');

#Delete Buku Umum Route
Route::get('/delete/{uuid}', [DeleteBukuUmum::class, 'index'])
    ->name('delete');
Route::post('/delete/submit', [DeleteBukuUmum::class, 'onSubmit'])
    ->name('delete.submit');