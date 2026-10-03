<?php

namespace App\Http\Controllers\Modules\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Repositories\References\RefUserRepository;
use App\Repositories\Tokens\TokenForgetPasswordRepository;
use App\Traits\AuditAccess;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ResetPassword extends Controller
{
    use AuditAccess;

    private $moduleName = "Reset Password";

    public function __construct(
        private readonly RefUserRepository $refUserRepository,
        private readonly TokenForgetPasswordRepository $tokenForgetPasswordRepository,
        private Session $session
    )
    {
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

        try
        {
            $this->session::put('name', $dataUser->nama);
            $dataUpdateUser = [
                'password' => Hash::make($newPassword),
            ];
            $this->refUserRepository->update($dataUpdateUser, $dataToken->id_ref_user);

            $dataUpdateToken = [
                'status' => 0
            ];
            $this->tokenForgetPasswordRepository->update($dataUpdateToken, $dataToken->id);
            $this->session::remove('name');
        }
        catch (Exception $e)
        {
            Log::error($e);
            return response()
                ->redirectToRoute('auth.reset.password', ['token' => $token])
                ->with('error','Terjadi kesalahan saat menyimpan data');
        }

        return response()
            ->redirectToRoute('auth.login')
            ->with('success', 'Password telah direset, silahkan login dengan password baru anda.');
    }
}