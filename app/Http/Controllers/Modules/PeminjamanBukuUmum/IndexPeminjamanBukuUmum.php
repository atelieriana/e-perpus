<?php

namespace App\Http\Controllers\Modules\PeminjamanBukuUmum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexPeminjamanBukuUmum extends Controller
{
    public function __construct()
    {}

    public function index()
    {
        return view('modules.peminjaman-buku-umum.index');
    }
}
