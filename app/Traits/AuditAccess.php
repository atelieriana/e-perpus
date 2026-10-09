<?php

namespace App\Traits;

use App\Repositories\Audit\AuditAccessRepository;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

trait AuditAccess
{
    public function logAccess()
    {
        $data = [
            'uuid' => Str::uuid()->toString(),
            'module' => $this->moduleName,
            'user'=> Session::get('access-data')['nama'] ?? 'Guest',
            'url_access' => url()->current(),
            'method' => request()->method(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ];
        app(AuditAccessRepository::class)->create($data);
    }
}
