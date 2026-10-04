<?php

namespace App\Services\Auth;

use App\Exceptions\BusinessException;
use App\Interfaces\References\RefUserInterface;
use App\Services\EmailService;

readonly class ForgetPasswordService
{
    public function __construct(
        private RefUserInterface $refUserInterface,
        private EmailService $emailService,
        private TokenForgetPasswordService $tokenForgetPasswordService,
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
            ?? throw new BusinessException("Data email tidak ditemukan.");

        $token = $this->tokenForgetPasswordService->generateForgetToken($dataUser);
        $link = route('auth.reset.password',['token'=>$token]);

        $this->emailService->sendEmailForgetPassword($dataUser->toArray(), $link);
    }
}