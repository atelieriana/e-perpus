<?php

namespace App\Repositories\Tokens;

use App\Interfaces\Tokens\TokenForgetPasswordInterface;
use App\Models\Tokens\TokenForgetPassword;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPasswordRepository newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPasswordRepository newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPasswordRepository onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPasswordRepository query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPasswordRepository whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPasswordRepository whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPasswordRepository whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPasswordRepository whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPasswordRepository whereExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPasswordRepository whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPasswordRepository whereIdRefUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPasswordRepository whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPasswordRepository whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPasswordRepository whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPasswordRepository whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPasswordRepository whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPasswordRepository withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TokenForgetPasswordRepository withoutTrashed()
 * @mixin \Eloquent
 */
class TokenForgetPasswordRepository extends BaseRepository implements TokenForgetPasswordInterface
{
    public function __construct(protected TokenForgetPassword $tokenForgetPassword)
    {
        parent::__construct($tokenForgetPassword);
    }

    public function findDataTokenByToken(string $token)
    {
        return $this->tokenForgetPassword
            ->newQuery()
            ->where('token', $token)
            ->where('status', 1)
            ->where('expired_at', '>', now())
            ->first();
    }
}