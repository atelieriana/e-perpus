<?php

namespace App\Repositories\Audit;

use App\Models\Audit\AuditTrail;

/**
 * @property int $id
 * @property string $uuid
 * @property string|null $executed_by
 * @property string|null $event
 * @property string|null $auditable_type
 * @property string|null $auditable_id
 * @property array<array-key, mixed>|null $old_values
 * @property array<array-key, mixed>|null $new_values
 * @property string|null $url
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent|null $auditable
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditTrailRepository newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditTrailRepository newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditTrailRepository query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditTrailRepository whereAuditableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditTrailRepository whereAuditableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditTrailRepository whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditTrailRepository whereEvent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditTrailRepository whereExecutedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditTrailRepository whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditTrailRepository whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditTrailRepository whereNewValues($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditTrailRepository whereOldValues($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditTrailRepository whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditTrailRepository whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditTrailRepository whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditTrailRepository whereUuid($value)
 * @mixin \Eloquent
 */
readonly class AuditTrailRepository
{
    public function __construct(
        private readonly AuditTrail $auditTrail
    )
    {}
}
