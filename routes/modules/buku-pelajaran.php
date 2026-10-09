<?php

use App\Http\Controllers\Modules\BukuPelajaran\CreateBukuPelajaran;
use App\Http\Controllers\Modules\BukuPelajaran\IndexBukuPelajaran;
use App\Http\Controllers\Modules\BukuPelajaran\UpdateBukuPelajaran;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexBukuPelajaran::class, 'index'])
    ->name('index');
Route::get('/create', [CreateBukuPelajaran::class, 'index'])
    ->name('create');
Route::post('/create/submit',[CreateBukuPelajaran::class, 'onSubmit'])
    ->name('create.submit');
Route::get('/update/{uuid}', [UpdateBukuPelajaran::class, 'index'])
    ->name('update');
Route::post('/update/submit', [UpdateBukuPelajaran::class, 'onSubmit'])
    ->name('update.submit');