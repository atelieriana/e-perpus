<?php

namespace App\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use OwenIt\Auditing\Auditable;

trait AuditTransaction
{
    use Auditable;

    private Session $session;
    public function __construct()
    {
        parent::__construct();
        $this->session = new Session();
    }

    /**
     * Digunakan untuk melakukan transformasi data kebutuhan Audit Trail
     *
     * @param array $data
     * @return array
     */
    public function transformAudit(array $data): array
    {
        Arr::set($data, 'executed_by', $this->session::get('access-data')->nip);
        Arr::set($data, 'event', $data['event']);
        Arr::set($data, 'auditable_type', $this->getTable());
        Arr::set($data, 'auditable_id', $this->getKey());
        Arr::set($data, 'old_values', $data['old_values']);
        Arr::set($data, 'new_values', $data['new_values']);
        Arr::set($data, 'url', $data['url']);
        Arr::set($data, 'ip_address', $data['ip_address']);
        Arr::set($data, 'user_agent', $data['user_agent']);
        return $data;
    }
}
