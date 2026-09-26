<?php

use App\Http\Controllers\Modules\Landing\Landing;
use Illuminate\Support\Facades\Route;

Route::get('/', [Landing::class, 'index'])
    ->name('landing');
