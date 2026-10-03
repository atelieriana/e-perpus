<?php

namespace App\Http\Controllers\Modules\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgetPasswordRequest;
use App\Mail\ForgetPasswordMail;
use App\Repositories\References\RefUserRepository;
use App\Repositories\Tokens\TokenForgetPasswordRepository;
use App\Traits\AuditAccess;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ForgetPassword extends Controller
{
    use AuditAccess;

    private $moduleName = 'Forget Password';

    public function __construct(
        private readonly RefUserRepository $refUserRepository,
        private readonly TokenForgetPasswordRepository $tokenForgetPasswordRepository,
        private readonly Session $session,
        private readonly Mail $mail
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
        $email = $request->input('email');
        $dataUser = $this->refUserRepository->findDataByEmail($email);
        if (is_null($dataUser)) {
            return response()
                ->redirectToRoute('auth.forget.password')
                ->with('error','Data email tidak ditemukan');
        }

        $this->session::put('name', $dataUser->nama);

        try
        {
            $uuidTokenForgetPassword = Str::uuid()->toString();
            $token = base64_encode($uuidTokenForgetPassword.$dataUser->uuid);
            $dataTokenForgetPassword = [
                'uuid' => $uuidTokenForgetPassword,
                'id_ref_user' => $dataUser->id,
                'token' => $token,
                'expired_at' => Carbon::now('Asia/Jakarta')->addMinutes(30),
                'status' => 1,
                'created_by' => $this->session::get('name'),
                'updated_by' => $this->session::get('name'),
            ];
            $this->tokenForgetPasswordRepository->create($dataTokenForgetPassword);
        }
        catch (Exception $e)
        {
            Log::error($e->getMessage());
            return response()
                ->redirectToRoute('auth.forget.password')
                ->with('error', 'Terjadi kesalahan saat menyimpan data');
        }

        $this->session::remove('name');

        $linkResetPassword = route('auth.reset.password',['token'=>$token]);

        $dataEmail = [
            'nama' => $dataUser->nama,
            'link' => $linkResetPassword
        ];

        $this->mail::to($dataUser->email)
            ->send(new ForgetPasswordMail($dataEmail));

        return view('modules.auth.check-email');
    }
}