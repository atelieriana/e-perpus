<?php

namespace App\Repositories\References;

use App\Models\References\RefRoleDetail;
use App\Models\References\RefUser;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRoleDetailRepository newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRoleDetailRepository newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRoleDetailRepository query()
 * @mixin \Eloquent
 */
readonly class RefRoleDetailRepository
{
    public function __construct(
        private readonly RefRoleDetail $refRoleDetail,
    ){}

    public function findIdDefaultRole(RefUser $user): ?int
    {
        return $user->roles_detail->firstWhere('is_default_role', 1)->id_ref_role;
    }
}