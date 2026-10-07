<?php

use App\Http\Controllers\Modules\BukuPelajaran\CreateBukuPelajaran;
use App\Http\Controllers\Modules\BukuPelajaran\IndexBukuPelajaran;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexBukuPelajaran::class, 'index'])
    ->name('buku.index');
Route::get('/create', [CreateBukuPelajaran::class, 'index'])
    ->name('buku.create');
Route::post('/create/submit',[CreateBukuPelajaran::class, 'onSubmit'])
    ->name('buku.create.submit');