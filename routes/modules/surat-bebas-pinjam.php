<?php

use App\Http\Controllers\Modules\SuratBebasPinjam\CetakBebasSuratPinjam;
use App\Http\Controllers\Modules\SuratBebasPinjam\CreateBebasSuratPinjam;
use App\Http\Controllers\Modules\SuratBebasPinjam\DeleteBebasSuratPinjam;
use App\Http\Controllers\Modules\SuratBebasPinjam\IndexBebasSuratPinjam;
use App\Http\Controllers\Modules\SuratBebasPinjam\UpdateBebasSuratPinjam;

Route::get('/', [IndexBebasSuratPinjam::class,'index'])
    ->name('index');

Route::get('/create', [CreateBebasSuratPinjam::class,'index'])
    ->name('create');
Route::post('/create/submit', [CreateBebasSuratPinjam::class,'onSubmit'])
    ->name('create.submit');

Route::get('/update/{uuid}', [UpdateBebasSuratPinjam::class,'index'])
    ->name('update');
Route::get('/update/submit', [UpdateBebasSuratPinjam::class,'onSubmit'])
    ->name('update.submit');

Route::get('/delete/{uuid}', [DeleteBebasSuratPinjam::class,'index'])
    ->name('delete');
Route::get('/delete/submit', [DeleteBebasSuratPinjam::class,'onSubmit'])
    ->name('delete.submit');

Route::get('/cetak/{uuid}', CetakBebasSuratPinjam::class)
    ->name('cetak');