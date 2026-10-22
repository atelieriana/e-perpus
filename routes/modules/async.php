<?php

use App\Http\Controllers\AsyncRequest\KodeKelas;
use App\Http\Controllers\AsyncRequest\PenempatanSiswa;

Route::post('/kode-kelas',[KodeKelas::class,'getKodeKelasByKelasAndKejuruan'])
    ->name('kode-kelas');
Route::post('/penempatan-siswa',[PenempatanSiswa::class,'listPenempatanSiswa'])
    ->name('penempatan-siswa');
Route::post('/tanpa-kelas',[PenempatanSiswa::class,'listSiswaTanpaKelas'])
    ->name('tanpa-kelas');
Route::post('/hapus-dari-kelas',[PenempatanSiswa::class,'hapusSiswaDariKelas'])
    ->name('hapus-dari-kelas');
Route::post('/tambah-ke-kelas',[PenempatanSiswa::class,'tambahSiswaKeKelas'])
    ->name('tambah-ke-kelas');