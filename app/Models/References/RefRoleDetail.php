<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $uuid
 * @property int|null $id_ref_user
 * @property int|null $id_ref_role
 * @property int|null $is_default_role
 * @property string|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_by
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRoleDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRoleDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRoleDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRoleDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRoleDetail whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRoleDetail whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRoleDetail whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRoleDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRoleDetail whereIdRefRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRoleDetail whereIdRefUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRoleDetail whereIsDefaultRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRoleDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRoleDetail whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRoleDetail whereUuid($value)
 * @mixin \Eloquent
 */
class RefRoleDetail extends Model
{
    protected $table = 'ref_role_detail';
    protected $primaryKey = 'id';
}