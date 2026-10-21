<?php

use App\Http\Controllers\AsyncRequest\KodeKelas;
use App\Http\Controllers\AsyncRequest\PenempatanSiswa;

Route::post('/kode-kelas',[KodeKelas::class,'getKodeKelasByKelasAndKejuruan'])
    ->name('kode-kelas');
Route::post('/penempatan-siswa',[PenempatanSiswa::class,'listPenempatanSiswa'])
    ->name('penempatan-siswa');