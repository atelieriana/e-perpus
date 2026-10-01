<?php

namespace App\Models\Audit;

use Illuminate\Database\Eloquent\Model;

class AuditAccess extends Model
{
    protected $table      = 'audit_access';
    protected $primaryKey = 'id';

    protected $fillable = [
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
