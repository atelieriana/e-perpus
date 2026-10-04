<?php

namespace App\Http\Controllers\Modules\Auth;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Services\Auth\TokenForgetPasswordService;
use App\Services\RefUserServices;
use App\Traits\AuditAccess;
use Illuminate\Support\Facades\Log;

class ResetPassword extends Controller
{
    use AuditAccess;

    private $moduleName = "Reset Password";

    public function __construct(
        private readonly RefUserServices $refUserServices,
        private readonly TokenForgetPasswordService $tokenForgetPasswordService,
    )
    {
        $this->logAccess();
    }

    public function index(string $token)
    {
        try
        {
            $dataToken = $this->tokenForgetPasswordService->validateForgetToken($token);
        }
        catch (BusinessException $exception)
        {
            Log::error($exception->getMessage());
            return response()
                ->redirectToRoute('auth.forget.password')
                ->withErrors($exception->getMessage());
        }
        return view('modules.auth.reset-password', compact('dataToken'));
    }

    public function onSubmit(ResetPasswordRequest $request)
    {
        try
        {
            $this->refUserServices->updatePassword($request->validated());
            $this->tokenForgetPasswordService->invalidateForgetToken($request->validated());
        }
        catch (BusinessException $exception)
        {
            return response()
                ->redirectToRoute('auth.reset.password', ['token' => $request->token])
                ->with('error', $exception->getMessage());
        }

        return response()
            ->redirectToRoute('auth.login')
            ->with('success','Password berhasil diubah. Silahkan login kembali dengan password terbaru anda.');
    }
}