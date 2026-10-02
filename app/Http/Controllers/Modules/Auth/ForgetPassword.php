<?php

namespace App\Http\Controllers\Modules\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgetPasswordRequest;
use App\Mail\ForgetPasswordMail;
use App\Models\References\RefUser;
use App\Repositories\References\RefUserRepository;
use App\Repositories\Tokens\TokenForgetPasswordRepository;
use App\Traits\AuditAccess;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ForgetPassword extends Controller
{
    use AuditAccess;

    private Carbon $carbon;
    private Str $str;
    private Mail $mail;
    private Session $session;
    private RefUserRepository $refUserRepository;
    private TokenForgetPasswordRepository $tokenForgetPasswordRepository;
    private $moduleName = 'Forget Password';

    public function __construct()
    {
        $this->carbon = new Carbon();
        $this->str = new Str();
        $this->mail = new Mail();
        $this->session = new Session();
        $this->refUserRepository = new RefUserRepository();
        $this->tokenForgetPasswordRepository = new TokenForgetPasswordRepository();
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

        $this->session::put('nama', $dataUser->nama);

        $this->tokenForgetPasswordRepository->uuid = $this->str->uuid()->toString();
        $this->tokenForgetPasswordRepository->id_ref_user = $dataUser->id;
        $this->tokenForgetPasswordRepository->token = base64_encode($this->tokenForgetPasswordRepository->uuid.$this->refUserRepository->uuid);
        $this->tokenForgetPasswordRepository->expired_at = $this->carbon->now()->addMinutes(30);
        $this->tokenForgetPasswordRepository->created_by = $dataUser->nama;
        $this->tokenForgetPasswordRepository->updated_by = $dataUser->nama;
        $this->tokenForgetPasswordRepository->save();

        $this->session::flush();

        $linkResetPassword = route('auth.reset.password',['token'=>$this->tokenForgetPasswordRepository->token]);

        $dataEmail = [
            'nama' => $dataUser->nama,
            'link' => $linkResetPassword
        ];

        $this->mail::to($dataUser->email)
            ->send(new ForgetPasswordMail($dataEmail));

        return view('modules.auth.check-email');
    }
}