<?php

use App\Http\Controllers\Modules\Auth\Login;
use Illuminate\Support\Facades\Route;

Route::get('/login',[Login::class,'index'])
    ->name('login');
Route::post('/login/submit',[Login::class,'onSubmit'])
    ->name('login.submit');