<?php

namespace App\Http\Controllers\Modules\HibahBuku;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexHibahBuku extends Controller
{
    public function __construct()
    {}

    public function index()
    {
        return view('modules.hibah-buku.index');
    }
}
