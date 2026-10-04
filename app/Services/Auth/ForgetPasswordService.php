<?php

namespace App\Services\Auth;

use App\Exceptions\BusinessException;
use App\Interfaces\References\RefUserInterface;
use App\Interfaces\Tokens\TokenForgetPasswordInterface;
use App\Services\EmailService;
use Illuminate\Database\QueryException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

readonly class ForgetPasswordService
{
    public function __construct(
        private RefUserInterface $refUserInterface,
        private TokenForgetPasswordInterface $tokenForgetPasswordInterface,
        private EmailService $emailService,
        private Session $session,
    )
    {}

    /**
     * Digunakan untuk memastikan email apakah terdaftar atau tidak
     * @param array $data
     * @return void
     */
    public function sendEmail(array $requestData)
    {
        $dataUser = $this->refUserInterface->findDataByEmail($requestData['email'])
            ?? throw new BusinessException("Data email '{$requestData['email']}' tidak ditemukan.");

        $token = $this->generateForgetToken($dataUser);
        $link = route('auth.reset.password',['token'=>$token]);

        $this->emailService->sendEmailForgetPassword($dataUser->toArray(), $link);
    }

    /**
     * @param array $dataUser
     * @return string
     */
    private function generateForgetToken(object $dataUser): string
    {
        $this->session::put('name', $dataUser['name']);

        try
        {
            $uuidTokenForgetPassword = Str::uuid()->toString();
            $token = base64_encode($uuidTokenForgetPassword.$dataUser['uuid']);
            $dataTokenForgetPassword = [
                'uuid' => $uuidTokenForgetPassword,
                'id_ref_user' => $dataUser['id'],
                'token' => $token,
                'expired_at' => Carbon::now('Asia/Jakarta')->addMinutes(30),
                'status' => 1,
                'created_by' => $this->session::get('name'),
                'updated_by' => $this->session::get('name'),
            ];
            $this->tokenForgetPasswordInterface->create($dataTokenForgetPassword);
        }
        catch (QueryException $e)
        {
            Log::error($e->getMessage());
            throw new BusinessException("Gagal melakukan generate token.");
        }

        $this->session::remove('name');

        return $token;
    }
}