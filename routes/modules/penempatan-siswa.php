<?php

#Routing Index Penempatan Siswa
use App\Http\Controllers\Modules\PenempatanSiswa\CreatePenempatanSiswa;
use App\Http\Controllers\Modules\PenempatanSiswa\IndexPenempatanSiswa;

Route::get('/', [IndexPenempatanSiswa::class, 'index'])
    ->name('index');

#Routing Create Penempatan Siswa
Route::get('/create', [CreatePenempatanSiswa::class, 'index'])
    ->name('create');
Route::post('/submit', [CreatePenempatanSiswa::class, 'onSubmit'])
    ->name('create.submit');

#Routing Update Penempatan Siswa
Route::get('/update/{uuid}', [UpdatePenempatanSiswa::class, 'index'])
    ->name('update');
Route::post('/update/submit', [UpdatePenempatanSiswa::class, 'onSubmit'])
    ->name('update.submit');

#Routing Delete Penempatan Siswa
Route::get('/delete/{uuid}', [DeletePenempatanSiswa::class, 'index'])
    ->name('delete');
Route::post('/delete/submit', [DeletePenempatanSiswa::class, 'onSubmit'])
    ->name('delete.submit');