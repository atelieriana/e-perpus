<?php

namespace App\Http\Controllers\Modules\TahunAjar;

use App\Http\Controllers\Controller;
use App\Http\Requests\TahunAjar\DeleteRequest;
use App\Services\TahunAjarServices;
use App\Traits\AuditAccess;
use Illuminate\Http\Request;

class DeleteTahunAjar extends Controller
{
    use AuditAccess;
    private $moduleName = 'Tahun Ajar - Hapus';
    public function __construct(
        private TahunAjarServices $tahunAjarServices
    )
    {
        $this->logAccess();
    }

    public function index(string $uuid)
    {

    }

    public function onSubmit(DeleteRequest $request)
    {

    }
}
