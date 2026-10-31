<?php

use App\Http\Controllers\Modules\SuratBebasPinjam\DownloadBebasSuratPinjam;
use App\Http\Controllers\Modules\SuratBebasPinjam\GenerateBebasSuratPinjam;
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
Route::post('/update/submit', [UpdateBebasSuratPinjam::class,'onSubmit'])
    ->name('update.submit');

Route::get('/delete/{uuid}', [DeleteBebasSuratPinjam::class,'index'])
    ->name('delete');
Route::post('/delete/submit', [DeleteBebasSuratPinjam::class,'onSubmit'])
    ->name('delete.submit');

Route::get('/generate/{uuid}', GenerateBebasSuratPinjam::class)
    ->name('generate');

Route::get('/download/{uuid}', DownloadBebasSuratPinjam::class)
    ->name('download');