<?php

namespace App\Http\Controllers\Modules\TahunAjar;

use App\Http\Controllers\Controller;
use App\Http\Requests\TahunAjar\UpdateRequest;
use App\Services\TahunAjarServices;
use App\Traits\AuditAccess;
use Illuminate\Http\Request;

class UpdateTahunAjar extends Controller
{
    use AuditAccess;
    private $moduleName = 'Tahun Ajar - Update';

    public function __construct(
        private TahunAjarServices $tahunAjarServices
    )
    {
        $this->logAccess();
    }

    public function index(string $uuid)
    {

    }

    public function onSubmit(UpdateRequest $request)
    {

    }
}
