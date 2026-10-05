<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRole query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRole whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRole whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRole whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRole whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRole whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRole whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRole whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRole whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefRole whereUuid($value)
 * @mixin \Eloquent
 */
class RefRole extends Model
{
    protected $table = 'ref_role';
    protected $primaryKey = 'id';
}