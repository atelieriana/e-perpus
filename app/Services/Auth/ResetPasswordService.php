<?php

namespace App\Services\Auth;

use App\Interfaces\References\RefUserInterface;

class ResetPasswordService
{
    public function __construct(
        private RefUserInterface $refUserInterface
    )
    {}

    public function saveNewPassword()
    {

    }
}