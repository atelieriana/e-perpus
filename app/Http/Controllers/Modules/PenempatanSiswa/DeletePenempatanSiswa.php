<?php

namespace App\Http\Controllers\Modules\PenempatanSiswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\PenempatanSiswa\DeleteRequest;
use App\Traits\AuditAccess;
use Illuminate\Http\Request;

class DeletePenempatanSiswa extends Controller
{
    use AuditAccess;

    private $moduleName = 'Penempatan Siswa - Delete';

    public function __construct(

    )
    {
        $this->logAccess();
    }

    public function index()
    {

    }

    public function onSubmit(DeleteRequest $request)
    {

    }
}
