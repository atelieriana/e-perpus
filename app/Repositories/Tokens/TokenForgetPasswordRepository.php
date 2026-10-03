<?php

namespace App\Repositories\Tokens;

use App\Models\Tokens\TokenForgetPassword;

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
readonly class TokenForgetPasswordRepository
{
    public function __construct(
        private readonly TokenForgetPassword $tokenForgetPassword,
    )
    {}

    public function create(array $data): TokenForgetPassword
    {
        return $this->tokenForgetPassword
            ->newQuery()
            ->create($data);
    }

    public function update(array $data, int $id)
    {
        return $this->tokenForgetPassword
            ->newQuery()
            ->findOrFail($id)
            ->update($data);
    }

    public function delete(int $id)
    {
        return $this->tokenForgetPassword
            ->newQuery()
            ->whereKey($id)
            ->delete();
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