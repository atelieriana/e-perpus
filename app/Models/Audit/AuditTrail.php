<?php

namespace App\Models\Audit;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Audit;

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
