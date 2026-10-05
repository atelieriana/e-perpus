<?php

namespace App\Repositories\References;

use App\Interfaces\References\RefRoleDetailInterface;
use App\Models\References\RefRoleDetail;
use App\Models\References\RefUser;
use App\Repositories\BaseRepository;

/**
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRoleDetailRepository newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRoleDetailRepository newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRoleDetailRepository query()
 * @mixin \Eloquent
 */
class RefRoleDetailRepository extends BaseRepository implements RefRoleDetailInterface
{
    public function __construct(protected RefRoleDetail $refRoleDetail)
    {
        parent::__construct($refRoleDetail);
    }

    public function findIdDefaultRole(RefUser $refUser): ?int
    {
        return $refUser->roles_detail->firstWhere('is_default_role', 1)->id_ref_role;
    }
}