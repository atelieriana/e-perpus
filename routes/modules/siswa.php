<?php

use App\Http\Controllers\Modules\Siswa\CreateSiswa;
use App\Http\Controllers\Modules\Siswa\IndexSiswa;
use App\Http\Controllers\Modules\Siswa\UpdateSiswa;

#Routing Index Siswa
Route::get('/', [IndexSiswa::class, 'index'])
    ->name('index');

#Routing Create Siswa
Route::get('/create', [CreateSiswa::class, 'index'])
    ->name('create');
Route::post('/submit', [CreateSiswa::class, 'onSubmit'])
    ->name('create.submit');

#Routing Update Siswa
Route::get('/update/{uuid}', [UpdateSiswa::class, 'index'])
    ->name('update');
Route::post('/update/submit', [UpdateSiswa::class, 'update'])
    ->name('update.submit');