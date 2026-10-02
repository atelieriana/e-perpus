<?php

use App\Http\Controllers\Modules\Auth\ForgetPassword;
use App\Http\Controllers\Modules\Auth\Login;
use App\Http\Controllers\Modules\Auth\ResetPassword;
use Illuminate\Support\Facades\Route;

# Login Page
Route::get('/login',[Login::class,'index'])
    ->name('login');
Route::post('/login/submit',[Login::class,'onSubmit'])
    ->name('login.submit');

# Forget password
Route::get('/forget-password',[ForgetPassword::class,'index'])
    ->name('forget.password');
Route::post('/forget-password/submit',[ForgetPassword::class,'onSubmit'])
    ->name('forget.password.submit');

# Reset Email
Route::get('/reset-password/{token}',[ResetPassword::class,'index'])
    ->name('reset.password');
Route::post('/reset-password/submit',[ResetPassword::class,'onSubmit'])
    ->name('reset.password.submit');