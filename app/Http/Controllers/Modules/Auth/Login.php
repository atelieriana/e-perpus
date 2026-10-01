<?php

namespace App\Http\Controllers\Modules\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Repositories\References\RefUserRepository;
use Illuminate\Support\Facades\Hash;

class Login extends Controller
{
    private RefUserRepository $refUserRepository;

    public function __construct()
    {
        $this->refUserRepository = new RefUserRepository();
    }

    public function index()
    {
        return view('modules.auth.login');
    }

    public function onSubmit(LoginRequest $request)
    {
        $username = $request->post('username');
        $password = $request->post('password');
        $dataUser = $this->refUserRepository->findDataByUsername($username);

        if (is_null($dataUser)) {
            return response()
                ->redirectToRoute('auth.login')
                ->with('error', 'Username atau password salah!');
        }

        if (Hash::check($password, $dataUser->password))
        {
            echo "Dashboard";
        }
        else
        {
            return response()
                ->redirectToRoute('auth.login')
                ->with('error', 'Username atau password salah!');
        }
    }
}
