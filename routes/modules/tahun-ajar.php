<?php

use App\Http\Controllers\Modules\TahunAjar\CreateTahunAjar;
use App\Http\Controllers\Modules\TahunAjar\DeleteTahunAjar;
use App\Http\Controllers\Modules\TahunAjar\IndexTahunAjar;
use App\Http\Controllers\Modules\TahunAjar\UpdateTahunAjar;

#Routing Index Tahun Ajar
Route::get('/', [IndexTahunAjar::class, 'index'])
    ->name('index');

#Routing Create Tahun Ajar
Route::get('/create', [CreateTahunAjar::class, 'index'])
    ->name('create');
Route::post('/submit', [CreateTahunAjar::class, 'onSubmit'])
    ->name('create.submit');

#Routing Update Tahun Ajar
Route::get('/update/{uuid}', [UpdateTahunAjar::class, 'index'])
    ->name('update');
Route::post('/update/submit', [UpdateTahunAjar::class, 'onSubmit'])
    ->name('update.submit');

#Routing Delete Tahun Ajar
Route::get('/delete/{uuid}', [DeleteTahunAjar::class, 'index'])
    ->name('delete');
Route::post('/delete/submit', [DeleteTahunAjar::class, 'onSubmit'])
    ->name('delete.submit');