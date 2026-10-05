<?php

namespace App\Models\Audit;

use Illuminate\Database\Eloquent\Model;

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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditAccess newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditAccess newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditAccess query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditAccess whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditAccess whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditAccess whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditAccess whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditAccess whereModule($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditAccess whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditAccess whereUrlAccess($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditAccess whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditAccess whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditAccess whereUuid($value)
 * @mixin \Eloquent
 */
class AuditAccess extends Model
{
    protected $table      = 'audit_access';
    protected $primaryKey = 'id';

    protected $fillable = [
        'uuid',
        'module',
        'user',
        'url_access',
        'method',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
