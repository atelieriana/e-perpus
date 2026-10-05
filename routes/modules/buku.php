<?php

use App\Http\Controllers\Modules\BukuPelajaran\IndexBukuPelajaran;

Route::get('/', [IndexBukuPelajaran::class, 'index'])
    ->name('buku.index');