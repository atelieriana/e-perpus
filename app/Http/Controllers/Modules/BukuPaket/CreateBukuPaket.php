<?php

namespace App\Http\Controllers\Modules\BukuPaket;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Datatables\BukuPelajaran;
use App\Http\Requests\BukuPaket\CreateRequest;
use App\Services\BukuService;
use App\Services\KejuruanService;
use App\Services\KelasService;
use App\Traits\AuditAccess;
use Illuminate\Http\Request;

class CreateBukuPaket extends Controller
{
    use AuditAccess;

    const BUKU_PELAJARAN = 2;
    private $moduleName = 'Buku Paket - Create';

    public function __construct(
        private bukuService $bukuService,
        private KelasService $kelasService,
        private KejuruanService $kejuruanService
    )
    {
        $this->logAccess();
    }

    public function index()
    {
        $listKelas = $this->kelasService->getAllRecord();
        $listKejuruan = $this->kejuruanService->getAllRecord();
        $listBuku = $this->bukuService->getBukuByJenisBuku(self::BUKU_PELAJARAN);
        return view('modules.buku-paket.create', compact('listKelas', 'listKejuruan','listBuku'));
    }

    public function onSubmit(CreateRequest $request)
    {

    }
}
