<?php

namespace App\Http\Controllers\Modules\Auth;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\LoginService;
use App\Traits\AuditAccess;

class Login extends Controller
{
    use AuditAccess;
    private $moduleName = 'Login';

    public function __construct(
        private readonly LoginService $loginService,
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
        try
        {
            $this->loginService->authenticate($request->validated());
        }
        catch (BusinessException $e)
        {
            return response()
                ->redirectToRoute('auth.login')
                ->withErrors($e->getMessage());
        }

        return response()
            ->redirectToRoute('dashboard')
            ->with('success', 'Hai');
    }
}
