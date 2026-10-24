<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

readonly class ChangeRoleService
{
    public function __construct()
    {}

    public function changeRole(string $targetedRole)
    {
        $listAllowedRole = Session::get('access-allowed-role');
        if (in_array($targetedRole, $listAllowedRole)) {
            Session::put('access-role', $targetedRole);
        }
    }
}