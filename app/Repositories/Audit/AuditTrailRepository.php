<?php

namespace App\Repositories\Audit;

use App\Models\Audit\AuditTrail;

class AuditTrailRepository extends AuditTrail
{
    public function getDatatables($tanggalMulai = null, $tanggalAkhir = null)
    {
        $query = $this->select(
            'id',
            'executed_by',
            'event',
            'auditable_type',
            'ip_address',
            'created_at'
        );

        if (!empty($tanggalMulai) && !empty($tanggalAkhir)) {
            $query
                ->where('created_at', '>=', $tanggalMulai . ' 00:00:00')
                ->where('created_at', '<=', $tanggalAkhir . ' 23:59:59');
        }

        return $query;
    }

    public function getExport($tanggalMulai, $tanggalAkhir)
    {
        return $this->select(
            'executed_by',
            'event',
            'auditable_type',
            'ip_address',
            'url',
            'created_at'
        )
            ->where('created_at', '>=', $tanggalMulai . ' 00:00:00')
            ->where('created_at', '<=', $tanggalAkhir . ' 23:59:59')
            ->orderBy('id');
    }

    public function getDetailByID($id)
    {
        return $this->select(
            'id',
            'executed_by',
            'event',
            'auditable_type',
            'old_values',
            'new_values',
            'url',
            'ip_address',
            'user_agent',
            'created_at'
        )
            ->where('id', $id)
            ->first();
    }
}
