<?php

namespace App\Http\Controllers\Modules\Auth;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgetPasswordRequest;
use App\Services\Auth\ForgetPasswordService;
use App\Traits\AuditAccess;

class ForgetPassword extends Controller
{
    use AuditAccess;

    private $moduleName = 'Forget Password';

    public function __construct(
        private ForgetPasswordService $forgetPasswordService,
    )
    {
        $this->logAccess();
    }

    public function index()
    {
        return view('modules.auth.forget-password');
    }

    public function onSubmit(ForgetPasswordRequest $request)
    {
        try
        {
            $this->forgetPasswordService->sendEmail($request->validated());
        }
        catch (BusinessException $exception)
        {
            return response()
                ->redirectToRoute('auth.forget.password')
                ->with('error', $exception->getMessage());
        }

        return view('modules.auth.check-email');
    }
}