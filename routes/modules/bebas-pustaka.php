<?php

use App\Http\Controllers\Modules\BebasPustaka\CreateBebasPustaka;
use App\Http\Controllers\Modules\BebasPustaka\DeleteBebasPustaka;
use App\Http\Controllers\Modules\BebasPustaka\IndexBebasPustaka;

Route::get('/', [IndexBebasPustaka::class,'index'])
    ->name('bebas-pustaka');

Route::get('/create', [CreateBebasPustaka::class,'index'])
    ->name('bebas-pustaka.create');
Route::post('/create/submit', [CreateBebasPustaka::class,'onSubmit'])
    ->name('bebas-pustaka.create.submit');

Route::get('/delete/{uuid}', [DeleteBebasPustaka::class,'index'])
    ->name('bebas-pustaka.delete');
Route::get('/delete/submit', [DeleteBebasPustaka::class,'onSubmit'])
    ->name('bebas-pustaka.submit');