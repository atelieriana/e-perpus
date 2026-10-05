<?php

namespace App\Services;

use App\Mail\ForgetPasswordMail;
use Illuminate\Support\Facades\Mail;

readonly class EmailService
{
    public function __construct(
        private Mail $mail,
    )
    {}

    /**
     * Digunakan untuk melakukan pengiriman email forget password
     * @param array $dataUser
     * @param string $linkResetPassword
     * @return void
     */
    public function sendEmailForgetPassword(array $dataUser, string $linkResetPassword)
    {
        $dataEmail = [
            'nama' => $dataUser['nama'],
            'link' => $linkResetPassword,
        ];

        $this->mail::to($dataUser['email'])
            ->send(new ForgetPasswordMail($dataEmail));
    }
}