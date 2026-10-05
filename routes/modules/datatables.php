<?php

use App\Http\Controllers\Datatables\Buku;

Route::post('/buku', Buku::class)
    ->name('buku');