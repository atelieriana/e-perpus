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
    });