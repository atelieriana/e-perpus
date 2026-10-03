<?php

namespace App\Http\Controllers\Modules\Dashboard;

use App\Http\Controllers\Controller;

class Dashboard extends Controller
{
    public function index()
    {
        return view('modules.dashboard.index');
    }
}