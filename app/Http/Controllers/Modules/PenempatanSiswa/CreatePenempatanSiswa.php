<?php

namespace App\Http\Controllers\Modules\PenempatanSiswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\PenempatanSiswa\CreateRequest;
use App\Traits\AuditAccess;
use Illuminate\Http\Request;

class CreatePenempatanSiswa extends Controller
{
    use AuditAccess;
    private $moduleName = 'Penempatan Siswa - Create';
    public function __construct()
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
