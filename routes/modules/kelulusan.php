<?php

use App\Http\Controllers\Modules\Kelulusan\CreateKelulusan;
use App\Http\Controllers\Modules\Kelulusan\IndexKelulusan;
use App\Http\Controllers\Modules\Kelulusan\RollbackKelulusan;
use App\Http\Controllers\Modules\Kelulusan\UpdateKelulusan;

Route::get('/', [IndexKelulusan::class, 'index'])
    ->name('index');

Route::get('/create', [CreateKelulusan::class, 'index'])
    ->name('create');
Route::post('/create/submit',[CreateKelulusan::class, 'onSubmit'])
    ->name('create.submit');

Route::post('/update/{uuidTahunAjar}', UpdateKelulusan::class)
    ->name('update.submit');

Route::get('/rollback/{uuid}', [RollbackKelulusan::class, 'index'])
    ->name('delete');
Route::post('/rollback/submit', [RollbackKelulusan::class, 'onSubmit'])
    ->name('delete.submit');