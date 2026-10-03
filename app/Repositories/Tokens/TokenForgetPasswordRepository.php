<?php

namespace App\Repositories\Tokens;

use App\Models\Tokens\TokenForgetPassword;

class TokenForgetPasswordRepository extends TokenForgetPassword
{
    public function findDataTokenByToken(string $token)
    {
        return self::where('token', $token)
            ->where('deleted_at', null)
            ->where('status', 1)
            ->where('expired_at', '>', now())
            ->first();
    }
}