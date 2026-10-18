<?php

namespace App\Http\Controllers\Modules\TahunAjar;

use App\Http\Controllers\Controller;
use App\Http\Requests\TahunAjar\CreateRequest;
use App\Services\TahunAjarServices;
use App\Traits\AuditAccess;
use Illuminate\Http\Request;

class CreateTahunAjar extends Controller
{
    use AuditAccess;
    private $moduleName = 'Tahun Ajar - Create';
    public function __construct(
        private TahunAjarServices $tahunAjarServices
    )
    {
        $this->logAccess();
    }

    public function index()
    {

    }

    public function onSubmit(CreateRequest $request)
    {

    }
}
