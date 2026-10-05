<?php

namespace App\Interfaces\Tokens;

use App\Repositories\Tokens\TokenForgetPasswordRepository;
use Illuminate\Container\Attributes\Bind;

#[Bind(TokenForgetPasswordRepository::class)]
interface TokenForgetPasswordInterface
{
    /**
     * Digunakan untuk mendapatkan data token forget password berdasarkan token
     * @param string $token
     * @return mixed
     */
    public function findDataTokenByToken(string $token);
}