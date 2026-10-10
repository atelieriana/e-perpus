<?php

use App\Http\Controllers\Modules\Auth\ForgetPassword;
use App\Http\Controllers\Modules\Auth\Login;
use App\Http\Controllers\Modules\Auth\Logout;
use App\Http\Controllers\Modules\Auth\ResetPassword;
use App\Http\Middleware\SessionLoginExist;
use App\Http\Middleware\SessionNotLoginExist;
use Illuminate\Support\Facades\Route;

# Login Page
Route::get('/login',[Login::class,'index'])
    ->name('login')
    ->middleware(SessionNotLoginExist::class);
Route::post('/login/submit',[Login::class,'onSubmit'])
    ->name('login.submit')
    ->middleware(SessionNotLoginExist::class);

#Logout
Route::get('/logout', Logout::class)
    ->name('logout');

# Forget password
Route::get('/forget-password',[ForgetPassword::class,'index'])
    ->name('forget.password')
    ->middleware(SessionNotLoginExist::class);
Route::post('/forget-password/submit',[ForgetPassword::class,'onSubmit'])
    ->name('forget.password.submit')
    ->middleware(SessionNotLoginExist::class);

# Reset Email
Route::get('/reset-password/{token}',[ResetPassword::class,'index'])
    ->name('reset.password');
Route::post('/reset-password/submit',[ResetPassword::class,'onSubmit'])
    ->name('reset.password.submit');