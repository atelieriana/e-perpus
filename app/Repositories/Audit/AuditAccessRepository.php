<?php

namespace App\Repositories\Audit;

use App\Models\Audit\AuditAccess;

class AuditAccessRepository extends AuditAccess
{
    public function getDatatables()
    {
        return $this->select(
            'id',
            'user',
            'method',
            'module',
            'url_access',
            'ip_address',
            'user_agent',
            'created_at'
        );
    }

    public function getExport($tanggalMulai, $tanggalAkhir, $filterMethod = null)
    {
        $query = $this->select(
            'user',
            'method',
            'module',
            'url_access',
            'ip_address',
            'user_agent',
            'created_at'
        )
            ->where('created_at', '>=', $tanggalMulai . ' 00:00:00')
            ->where('created_at', '<=', $tanggalAkhir . ' 23:59:59');

        if (!empty($filterMethod) && $filterMethod !== 'All Method') {
            $query->where('method', $filterMethod);
        }

        return $query->orderBy('id');
    }
}
