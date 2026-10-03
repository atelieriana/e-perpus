<?php

namespace App\Models\Tokens;

use App\Traits\AuditTransaction;
use App\Traits\LogTransaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * @property int $id
 * @property string|null $uuid
 * @property int|null $id_ref_user
 * @property string|null $token
 * @property string|null $expired_at
 * @property int|null $status
 * @property string|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit\AuditTrail> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPassword newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPassword newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPassword onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPassword query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPassword whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPassword whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPassword whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPassword whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPassword whereExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPassword whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPassword whereIdRefUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPassword whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPassword whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPassword whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPassword whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPassword whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPassword withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPassword withoutTrashed()
 * @mixin \Eloquent
 */
class TokenForgetPassword extends Model implements Auditable
{
    use SoftDeletes,
        AuditTransaction,
        LogTransaction;

    protected $table = 'token_forget_password';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'id_ref_user',
        'token',
        'status',
        'expired_at',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];
}