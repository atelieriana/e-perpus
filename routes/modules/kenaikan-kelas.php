<?php

use App\Http\Controllers\KenaikanKelas\IndexKenaikanKelas;
use App\Http\Controllers\KenaikanKelas\RollbackKenaikanKelas;
use App\Http\Controllers\KenaikanKelas\UpdateKenaikanKelas;

Route::get('/', [IndexKenaikanKelas::class, 'index'])
    ->name('index');

Route::post('/update/{uuidTahunAjar}', UpdateKenaikanKelas::class)
    ->name('update.submit');

Route::post('/rollback/{uuidTahunAjar}', RollbackKenaikanKelas::class)
    ->name('rollback.submit');