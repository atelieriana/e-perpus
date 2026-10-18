<?php

namespace App\Http\Controllers\Modules\Kejuruan;

use App\Http\Controllers\Controller;

class IndexKejuruan extends Controller
{

    public function index()
    {
        return view('modules.kejuruan.index');
    }
}
