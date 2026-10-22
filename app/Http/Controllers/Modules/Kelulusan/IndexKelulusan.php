<?php

namespace App\Http\Controllers\Modules\Kelulusan;

use App\Http\Controllers\Controller;

class IndexKelulusan extends Controller
{
    public function __construct()
    {}

    public function index()
    {
        return view('modules.kelulusan.index');
    }
}
