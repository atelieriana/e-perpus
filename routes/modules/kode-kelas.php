<?php

use App\Http\Controllers\Modules\KodeKelas\CreateKodeKelas;
use App\Http\Controllers\Modules\KodeKelas\DeleteKodeKelas;
use App\Http\Controllers\Modules\KodeKelas\IndexKodeKelas;
use App\Http\Controllers\Modules\KodeKelas\UpdateKodeKelas;

#Routing Index Kode Kelas
Route::get('/', [IndexKodeKelas::class, 'index'])
    ->name('index');

#Routing Create Kode Kelas
Route::get('/create', [CreateKodeKelas::class, 'index'])
    ->name('create');
Route::post('/submit', [CreateKodeKelas::class, 'onSubmit'])
    ->name('create.submit');

#Routing Update Kode Kelas
Route::get('/update/{uuid}', [UpdateKodeKelas::class, 'index'])
    ->name('update');
Route::post('/update/submit', [UpdateKodeKelas::class, 'onSubmit'])
    ->name('update.submit');

#Routing Delete Kode Kelas
Route::get('/delete/{uuid}', [DeleteKodeKelas::class, 'index'])
    ->name('delete');
Route::post('/delete/submit', [DeleteKodeKelas::class, 'onSubmit'])
    ->name('delete.submit');