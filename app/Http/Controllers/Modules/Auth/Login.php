<?php

namespace App\Http\Controllers\Modules\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\References\RefRole;
use App\Repositories\References\RefRoleDetailRepository;
use App\Repositories\References\RefRoleRepository;
use App\Repositories\References\RefUserRepository;
use App\Traits\AuditAccess;
use Illuminate\Support\Facades\Hash;

class Login extends Controller
{
    use AuditAccess;
    private $moduleName = 'Login';

    public function __construct(
        private readonly RefUserRepository $refUserRepository,
        private readonly RefRoleDetailRepository $refRoleDetailRepository,
        private readonly RefRoleRepository $refRoleRepository
    )
    {
        $this->logAccess();
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

        $idDefaultRole = $this->refRoleDetailRepository->findIdDefaultRole($dataUser);
        $dataDefaultRole = $this->refRoleRepository->findNameDefaultRole($dataUser, $idDefaultRole);
        if (is_null($dataDefaultRole))
        {
            return response()
                ->redirectToRoute('auth.login')
                ->with('error', 'Default role belum ditentukan, silahkan hubungi administrator!');
        }
        session()->put('access-role', $idDefaultRole);

        if (Hash::check($password, $dataUser->password))
        {
            session()->put('access-data', $dataUser);
            session()->put('access-allowed-role',  $dataUser->roles->pluck('role')->toArray());
            return response()
                ->redirectToRoute('dashboard');
        }

        return response()
            ->redirectToRoute('auth.login')
            ->with('error', 'Username atau password salah!');
    }
}
