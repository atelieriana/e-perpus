<?php

use App\Http\Controllers\Modules\Dashboard\Dashboard;
use App\Http\Controllers\Modules\Landing\Landing;
use App\Http\Middleware\SessionLoginExist;
use App\Http\Middleware\SessionNotLoginExist;
use Illuminate\Support\Facades\Route;

Route::get('/', [Landing::class, 'index'])
    ->name('landing');

Route::prefix('auth')
    ->name('auth.')
    ->group(__DIR__.'/modules/auth.php');

Route::middleware(SessionLoginExist::class)
    ->group(function(){
        #Routing Dashboard
        Route::get('/dashboard', [Dashboard::class, 'index'])
            ->name('dashboard');

        #Routing Async Request
        Route::prefix('async')
            ->name('async.')
            ->group(__DIR__.'/modules/async.php');

        #Routing Datatables
        Route::prefix('datatables')
            ->name('datatables.')
            ->group(__DIR__.'/modules/datatables.php');

        #Routing Referensi BukuPelajaran Pelajaran
        Route::prefix('buku-pelajaran')
            ->name('buku-pelajaran.')
            ->group(__DIR__ . '/modules/buku-pelajaran.php');

        #Routing Referensi BukuPelajaran Umum
        Route::prefix('buku-umum')
            ->name('buku-umum.')
            ->group(__DIR__ . '/modules/buku-umum.php');

        #Rouring Referensi Siswa
        Route::prefix('siswa')
            ->name('siswa.')
            ->group(__DIR__ . '/modules/siswa.php');

        #Routing Referensi Kejuruan
        Route::prefix('kejuruan')
            ->name('kejuruan.')
            ->group(__DIR__ . '/modules/kejuruan.php');

        #Routing Referensi Tahun Ajar
        Route::prefix('tahun-ajar')
            ->name('tahun-ajar.')
            ->group(__DIR__ . '/modules/tahun-ajar.php');

        #Routing Kode Kelas
        Route::prefix('kode-kelas')
            ->name('kode-kelas.')
            ->group(__DIR__ . '/modules/kode-kelas.php');

        #Routing Buku Paket
        Route::prefix('buku-paket')
            ->name('buku-paket.')
            ->group(__DIR__ . '/modules/buku-paket.php');

        #Routing Penempatan Siswa
        Route::prefix('penempatan-siswa')
            ->name('penempatan-siswa.')
            ->group(__DIR__ . '/modules/penempatan-siswa.php');

        #Routing Kenaikan Kelas
        Route::prefix('kelulusan')
            ->name('kelulusan.')
            ->group(__DIR__ . '/modules/kelulusan.php');

        #Routing Kenaikan Kelas
        Route::prefix('kenaikan-kelas')
            ->name('kenaikan-kelas.')
            ->group(__DIR__ . '/modules/kenaikan-kelas.php');

        #Routing Peminjaman Buku Pelajaran
        Route::prefix('peminjaman-buku-pelajaran')
            ->name('peminjaman-buku-pelajaran.')
            ->group(__DIR__ . '/modules/peminjaman-buku-pelajaran.php');

        #Routing Peminjaman Buku Umum
        Route::prefix('peminjaman-buku-umum')
            ->name('peminjaman-buku-umum.')
            ->group(__DIR__ . '/modules/peminjaman-buku-umum.php');

        #Routing Hibah Buku
        Route::prefix('hibah-buku')
            ->name('hibah-buku.')
            ->group(__DIR__ . '/modules/hibah-buku.php');
    });