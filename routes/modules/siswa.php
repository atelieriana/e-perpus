<?php

use App\Http\Controllers\Modules\Siswa\IndexSiswa;

Route::get('/', [IndexSiswa::class, 'index'])
    ->name('index');