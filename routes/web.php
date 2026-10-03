<?php

use App\Http\Controllers\Modules\Dashboard\Dashboard;
use App\Http\Controllers\Modules\Landing\Landing;
use Illuminate\Support\Facades\Route;

Route::get('/', [Landing::class, 'index'])
    ->name('landing');

Route::get('/dashboard', [Dashboard::class, 'index'])
    ->name('dashboard');

Route::prefix('auth')
    ->name('auth.')
    ->group(__DIR__.'/modules/auth.php');
