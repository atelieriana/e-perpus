<?php

namespace App\Http\Controllers\Modules\BebasSuratPinjam;

use App\Http\Controllers\Controller;

class IndexBebasSuratPinjam extends Controller
{
    public function __construct()
    {}

    public function index()
    {
        return view('modules.surat-bebas-pinjam.index');
    }
}
