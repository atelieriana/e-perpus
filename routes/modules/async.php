<?php

use App\Http\Controllers\AsyncRequest\KodeKelas;

Route::post('/kode-kelas',[KodeKelas::class,'getKodeKelasByKelasAndKejuruan'])
    ->name('kode-kelas');