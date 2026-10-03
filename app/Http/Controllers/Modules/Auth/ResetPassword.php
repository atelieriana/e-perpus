<?php

namespace App\Http\Controllers\Modules\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Repositories\References\RefUserRepository;
use App\Repositories\Tokens\TokenForgetPasswordRepository;
use App\Traits\AuditAccess;
use Illuminate\Support\Facades\Hash;

class ResetPassword extends Controller
{
    use AuditAccess;

    private TokenForgetPasswordRepository $tokenForgetPasswordRepository;
    private RefUserRepository $refUserRepository;
    private $moduleName = "Reset Password";

    public function __construct()
    {
        $this->tokenForgetPasswordRepository = new TokenForgetPasswordRepository();
        $this->refUserRepository = new RefUserRepository();

        $this->logAccess();
    }

    public function index(string $token)
    {
        $dataToken = $this->tokenForgetPasswordRepository->findDataTokenByToken($token);
        if (is_null($dataToken)) {
            return response()
                ->redirectToRoute('auth.forget.password')
                ->with('error', 'Token telah expired atau sudah digunakan. Silahkan kirim ulang kembali.');
        }

        return view('modules.auth.reset-password', compact('dataToken'));
    }

    public function onSubmit(ResetPasswordRequest $request)
    {
        $newPassword = $request->post('password');
        $token = $request->post('token');
        $dataToken = $this->tokenForgetPasswordRepository->findDataTokenByToken($token);

        // Save New Password
        $dataUser = $this->refUserRepository->findDataActiveUserById($dataToken->id_ref_user);
        if (is_null($dataUser)) {
            return response()
                ->redirectToRoute('auth.forget.password')
                ->with('error', 'Data user telah non aktif. Silahkan hubungi administrator.');
        }

        $dataUser->password = Hash::make($newPassword);
        $dataUser->save();

        // Invalidate Token
        $dataToken = $this->tokenForgetPasswordRepository->find($dataToken->id);
        $dataToken->status = 0;
        $dataToken->save();

        return response()
            ->redirectToRoute('auth.login')
            ->with('success', 'Password telah direset, silahkan login dengan password baru anda.');
    }
}