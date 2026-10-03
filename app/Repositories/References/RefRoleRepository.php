<?php

namespace App\Repositories\References;

use App\Models\References\RefRole;
use App\Models\References\RefUser;
use App\Repositories\BaseRepository;

/**
 * @property int $id
 * @property string $uuid
 * @property string $role
 * @property string $created_by
 * @property \Illuminate\Support\Carbon $created_at
 * @property string $updated_by
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string|null $deleted_by
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRoleRepository newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRoleRepository newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRoleRepository query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRoleRepository whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRoleRepository whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRoleRepository whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRoleRepository whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRoleRepository whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRoleRepository whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRoleRepository whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRoleRepository whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRoleRepository whereUuid($value)
 * @mixin \Eloquent
 */
class RefRoleRepository extends BaseRepository
{
    public function __construct( protected RefRole $refRole)
    {
        parent::__construct($refRole);
    }

    public function findNameDefaultRole(RefUser $user, int $idRole): ?string
    {
        return $user->roles->firstWhere('id', $idRole)->role;
    }
}