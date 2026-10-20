<?php

namespace App\Http\Controllers\Modules\PenempatanSiswa;

use App\Http\Controllers\Controller;
use App\Services\KejuruanService;
use App\Services\KelasService;
use App\Services\TahunAjarServices;
use App\Traits\AuditAccess;
use Illuminate\Http\Request;

class IndexPenempatanSiswa extends Controller
{
    use AuditAccess;
    private $moduleName = 'Penempatan Siswa - Index';

    public function __construct(
        private KelasService $kelasService,
        private KejuruanService $kejuruanService,
        private TahunAjarServices $tahunAjarService
    )
    {
        $this->logAccess();
    }

    public function index()
    {
        $listKelas = $this->kelasService->getAllRecord();
        $listKejuruan = $this->kejuruanService->getAllRecord();
        $listTahunAjar = $this->tahunAjarService->getAllRecord();
        return view('modules.penempatan-siswa.index', compact('listKelas', 'listKejuruan', 'listTahunAjar'));
    }
}
