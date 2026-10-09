<?php

namespace App\Models\References;

use App\Traits\AuditTransaction;
use App\Traits\LogTransaction;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * @property int $id
 * @property string $uuid
 * @property string $nama
 * @property string $username
 * @property string $password
 * @property string $email
 * @property int $status
 * @property string $created_by
 * @property \Illuminate\Support\Carbon $created_at
 * @property string $updated_by
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit\AuditTrail> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\References\RefRole> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\References\RefRoleDetail> $roles_detail
 * @property-read int|null $roles_detail_count
 * @method static Builder<static>|RefUser activeUser()
 * @method static Builder<static>|RefUser newModelQuery()
 * @method static Builder<static>|RefUser newQuery()
 * @method static Builder<static>|RefUser onlyTrashed()
 * @method static Builder<static>|RefUser query()
 * @method static Builder<static>|RefUser whereCreatedAt($value)
 * @method static Builder<static>|RefUser whereCreatedBy($value)
 * @method static Builder<static>|RefUser whereDeletedAt($value)
 * @method static Builder<static>|RefUser whereDeletedBy($value)
 * @method static Builder<static>|RefUser whereEmail($value)
 * @method static Builder<static>|RefUser whereId($value)
 * @method static Builder<static>|RefUser whereNama($value)
 * @method static Builder<static>|RefUser wherePassword($value)
 * @method static Builder<static>|RefUser whereStatus($value)
 * @method static Builder<static>|RefUser whereUpdatedAt($value)
 * @method static Builder<static>|RefUser whereUpdatedBy($value)
 * @method static Builder<static>|RefUser whereUsername($value)
 * @method static Builder<static>|RefUser whereUuid($value)
 * @method static Builder<static>|RefUser withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|RefUser withoutTrashed()
 * @mixin \Eloquent
 */
class RefUser extends Model implements Auditable
{
    use SoftDeletes,
        AuditTransaction,
        LogTransaction;

    protected $table = 'ref_user';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'nama',
        'username',
        'password',
        'email',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    protected $hidden = [
        'password',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at'
    ];

    public function roles()
    {
        return $this->belongsToMany(RefRole::class, RefRoleDetail::class, 'id_ref_user', 'id');
    }

    public function roles_detail()
    {
        return $this->hasMany(RefRoleDetail::class, 'id_ref_user', 'id');
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    #[Scope]
    public function activeUser(Builder $query): Builder
    {
        return $query->where('status', 1);
    }

    public function ref_role()
    {
        return $this->hasOneThrough(RefRole::class, RefRoleDetail::class, 'id_ref_user', 'id', 'id', 'id_ref_role');
    }
}
