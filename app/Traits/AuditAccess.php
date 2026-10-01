<?php

namespace App\Traits;

use App\Repositories\Audit\AuditAccessRepository;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

trait AuditAccess
{
    public function logAccess()
    {
        $auditAccessRepository = new AuditAccessRepository();
        $session = new Session();
        $auditAccessRepository->uuid = Str::uuid()->toString();
        $auditAccessRepository->module = $this->moduleName;
        $auditAccessRepository->user = $session::get('access-data')->username ?? 'Guest';
        $auditAccessRepository->url_access = url()->current();
        $auditAccessRepository->method = request()->method();
        $auditAccessRepository->ip_address = request()->ip();
        $auditAccessRepository->user_agent = request()->userAgent();
        $auditAccessRepository->save();
    }
}
