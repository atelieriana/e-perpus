<?php

namespace App\Services\Auth;

use App\Services\RefUserServices;

readonly class ResetPasswordService
{
    public function __construct(
        private RefUserServices $refUserServices,
        private TokenForgetPasswordService $tokenForgetPasswordService
    )
    {}

    public function saveNewPassword(array $requestData)
    {
        $dataForgetToken = $this->tokenForgetPasswordService->validateForgetToken($requestData['token']);
        dd($dataForgetToken);
    }
}