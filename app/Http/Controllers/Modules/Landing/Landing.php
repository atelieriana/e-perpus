<?php

namespace App\Http\Controllers\Modules\Landing;

use App\Http\Controllers\Controller;

class Landing extends Controller
{
    public function index()
    {
        return view('modules.landing.index');
    }
}
