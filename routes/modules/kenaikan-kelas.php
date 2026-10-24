<?php

use App\Http\Controllers\Modules\KenaikanKelas\IndexKenaikanKelas;
use App\Http\Controllers\Modules\KenaikanKelas\RollbackKenaikanKelas;
use App\Http\Controllers\Modules\KenaikanKelas\UpdateKenaikanKelas;

Route::get('/', [IndexKenaikanKelas::class, 'index'])
    ->name('index');

Route::post('/update', UpdateKenaikanKelas::class)
    ->name('update.submit');

Route::post('/rollback', RollbackKenaikanKelas::class)
    ->name('rollback.submit');