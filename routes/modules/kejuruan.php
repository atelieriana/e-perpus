<?php

use App\Http\Controllers\Modules\Kejuruan\CreateKejuruan;
use App\Http\Controllers\Modules\Kejuruan\DeleteKejuruan;
use App\Http\Controllers\Modules\Kejuruan\IndexKejuruan;
use App\Http\Controllers\Modules\Kejuruan\UpdateKejuruan;

Route::get('/', [IndexKejuruan::class, 'index'])
    ->name('index');
Route::get('/create', [CreateKejuruan::class, 'index'])
    ->name('create');
Route::post('/create/submit',[CreateKejuruan::class, 'onSubmit'])
    ->name('create.submit');
Route::get('/update/{uuid}', [UpdateKejuruan::class, 'index'])
    ->name('update');
Route::post('/update/submit', [UpdateKejuruan::class, 'onSubmit'])
    ->name('update.submit');
Route::get('/delete/{uuid}', [DeleteKejuruan::class, 'index'])
    ->name('delete');
Route::post('/delete/submit', [DeleteKejuruan::class, 'onSubmit'])
    ->name('delete.submit');