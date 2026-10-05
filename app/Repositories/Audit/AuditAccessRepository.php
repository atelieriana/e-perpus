<?php

namespace App\Repositories\Audit;

use App\Models\Audit\AuditAccess;

/**
 * @property int $id
 * @property string $uuid
 * @property string|null $module
 * @property string|null $user
 * @property string|null $url_access
 * @property string|null $method
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditAccessRepository newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditAccessRepository newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditAccessRepository query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditAccessRepository whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditAccessRepository whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditAccessRepository whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditAccessRepository whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditAccessRepository whereModule($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditAccessRepository whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditAccessRepository whereUrlAccess($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditAccessRepository whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditAccessRepository whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditAccessRepository whereUuid($value)
 * @mixin \Eloquent
 */
readonly class AuditAccessRepository
{
    public function __construct(
        private readonly AuditAccess $auditAccess,
    )
    {}

    public function create(array $data): AuditAccess
    {
        return $this->auditAccess->create($data);
    }
}
