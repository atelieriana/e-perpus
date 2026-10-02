<?php

namespace App\Repositories\References;

use App\Models\References\RefUser;

class RefUserRepository extends RefUser
{
    /**
     * Digunakan untuk melakukan pencarian data berdasarkan username
     * @param string $username
     * @return mixed
     */
    public function findDataByUsername(string $username)
    {
        return self::where('username', $username)
            ->where('deleted_at', null)
            ->first();
    }

    /**
     * Digunakan untuk melakukan pencarian data berdasarkan email
     * @param string $email
     * @return mixed
     */
    public function findDataByEmail(string $email)
    {
        return self::where('email', $email)
            ->where('deleted_at', null)
            ->first();
    }
}
