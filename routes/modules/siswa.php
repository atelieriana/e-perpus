<?php

use App\Http\Controllers\Modules\Siswa\CreateSiswa;
use App\Http\Controllers\Modules\Siswa\IndexSiswa;

#Routing Index Siswa
Route::get('/', [IndexSiswa::class, 'index'])
    ->name('index');

#Routing Create Siswa
Route::get('/create', [CreateSiswa::class, 'index'])
    ->name('create');
Route::post('/submit', [CreateSiswa::class, 'onSubmit'])
    ->name('create.submit');