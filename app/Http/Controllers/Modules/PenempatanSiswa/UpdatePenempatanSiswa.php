<?php

namespace App\Http\Controllers\Modules\PenempatanSiswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\PenempatanSiswa\UpdateRequest;
use App\Traits\AuditAccess;
use Illuminate\Http\Request;

class UpdatePenempatanSiswa extends Controller
{
    use AuditAccess;
    private $moduleName = 'Penempatan Siswa - Update';

    public function __construct()
    {
        $this->logAccess();
    }

    public function index()
    {

    }

    public function onSubmit(UpdateRequest $request)
    {

    }
}
