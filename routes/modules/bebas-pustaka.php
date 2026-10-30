<?php

use App\Http\Controllers\Modules\BebasPustaka\CetakBebasPustaka;
use App\Http\Controllers\Modules\BebasPustaka\CreateBebasPustaka;
use App\Http\Controllers\Modules\BebasPustaka\DeleteBebasPustaka;
use App\Http\Controllers\Modules\BebasPustaka\IndexBebasPustaka;
use App\Http\Controllers\Modules\BebasPustaka\UpdateBebasPustaka;

Route::get('/', [IndexBebasPustaka::class,'index'])
    ->name('bebas-pustaka');

Route::get('/create', [CreateBebasPustaka::class,'index'])
    ->name('create');
Route::post('/create/submit', [CreateBebasPustaka::class,'onSubmit'])
    ->name('create.submit');

Route::get('/update/{uuid}', [UpdateBebasPustaka::class,'index'])
    ->name('update');
Route::get('/update/submit', [UpdateBebasPustaka::class,'onSubmit'])
    ->name('update.submit');

Route::get('/delete/{uuid}', [DeleteBebasPustaka::class,'index'])
    ->name('delete');
Route::get('/delete/submit', [DeleteBebasPustaka::class,'onSubmit'])
    ->name('delete.submit');

Route::get('/cetak/{uuid}', CetakBebasPustaka::class)
    ->name('cetak');