<?php

namespace App\Http\Controllers\Modules\Auth;

use App\Http\Controllers\Controller;
use App\Services\ChangeRoleService;
use Illuminate\Http\Request;

class ChangeRole extends Controller
{
    public function __construct(
        private ChangeRoleService $changeRoleService
    )
    {}

    public function __invoke(Request $request)
    {
        $targetedRole = $request->post('targeted-role');
        $this->changeRoleService->changeRole($targetedRole);
    }
}