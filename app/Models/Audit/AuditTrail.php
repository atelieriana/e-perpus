<?php

namespace App\Models\Audit;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Audit;

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
 * @property-read Model|\Eloquent|null $auditable
 * @property-read Model|\Eloquent $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditTrail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditTrail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditTrail query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditTrail whereAuditableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditTrail whereAuditableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditTrail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditTrail whereEvent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditTrail whereExecutedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditTrail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditTrail whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditTrail whereNewValues($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditTrail whereOldValues($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditTrail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditTrail whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditTrail whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditTrail whereUuid($value)
 * @mixin \Eloquent
 */
class AuditTrail extends Model implements Audit
{
    use \OwenIt\Auditing\Audit;

    protected $table = "audit_trail";
    protected $primaryKey = "id";
    protected $casts = [
        'old_values' => 'json',
        'new_values' => 'json',
    ];

    protected $fillable = [
        'uuid',
        'executed_by',
        'event',
        'auditable_type',
        'auditable_id',
        'old_values',
        'new_values',
        'url',
        'ip_address',
        'user_agent'
    ];
}
