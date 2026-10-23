<?php

use App\Http\Controllers\Modules\Kelulusan\CreateKelulusan;
use App\Http\Controllers\Modules\Kelulusan\IndexKelulusan;
use App\Http\Controllers\Modules\Kelulusan\RollbackKelulusan;
use App\Http\Controllers\Modules\Kelulusan\UpdateKelulusan;

Route::get('/', [IndexKelulusan::class, 'index'])
    ->name('index');

Route::post('/update/{uuidTahunAjar}', UpdateKelulusan::class)
    ->name('update.submit');

Route::post('/rollback/{uuidTahunAjar}', RollbackKelulusan::class)
    ->name('rollback.submit');