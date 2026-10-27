<?php

use App\Http\Controllers\Modules\HibahBuku\CreateHibahBuku;
use App\Http\Controllers\Modules\HibahBuku\DeleteHibahBuku;
use App\Http\Controllers\Modules\HibahBuku\IndexHibahBuku;
use App\Http\Controllers\Modules\HibahBuku\UpdateHibahBuku;

Route::get('/', [IndexHibahBuku::class, 'index'])
    ->name('index');

Route::get('/create', [CreateHibahBuku::class, 'index'])
    ->name('create');
Route::post('/create/submit',[CreateHibahBuku::class, 'onSubmit'])
    ->name('create.submit');

Route::get('/update/{uuid}', [UpdateHibahBuku::class, 'index'])
    ->name('update');
Route::post('/update/submit', [UpdateHibahBuku::class, 'onSubmit'])
    ->name('update.submit');

Route::get('/delete/{uuid}', [DeleteHibahBuku::class, 'index'])
    ->name('delete');
Route::post('/delete/submit', [DeleteHibahBuku::class, 'onSubmit'])
    ->name('delete.submit');