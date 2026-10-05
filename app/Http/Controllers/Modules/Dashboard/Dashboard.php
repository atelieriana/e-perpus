<?php

namespace App\Http\Controllers\Modules\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\UserService;

class Dashboard extends Controller
{
    public function __construct(
        private UserService $userServices
    )
    {}

    public function index()
    {
        $dataUser = $this->userServices->getProfileUser(session()->get('access-data')['uuid']);
        return view('modules.dashboard.index');
    }
}