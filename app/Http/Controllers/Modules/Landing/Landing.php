<?php

namespace App\Http\Controllers\Modules\Landing;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Services\BukuService;
use App\Services\HibahBukuService;
use App\Services\HistoryPeminjamanService;
use App\Services\PeminjamanBukuUmumService;
use App\Services\SuratBebasPinjamService;
use App\Traits\AuditAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Landing extends Controller
{
    use AuditAccess;

    // Trait variable
    protected $moduleName = 'Landing - Page';

    public function __construct(
        private BukuService $bukuService,
        private PeminjamanBukuUmumService $peminjamanBukuUmumService,
        private HistoryPeminjamanService $historyPeminjamanService,
        private HibahBukuService $hibahBukuService,
        private SuratBebasPinjamService $suratBebasPinjamService,
    )
    {
        $this->logAccess();
    }

    public function index()
    {
        $listKoleksiBukuBaru = $this->bukuService->getLatestKoleksiBuku();
        $listPeminjamTerbanyak = $this->peminjamanBukuUmumService->getPeminjamanTerbanyak();
        return view('modules.landing.index', compact('listKoleksiBukuBaru','listPeminjamTerbanyak'));
    }

    public function katalogBuku(Request $request)
    {
        $listBuku = null;
        if (!is_null($request->input('pencarian')))
        {
            $listBuku = $this->bukuService->getBukuByParam(strtolower($request->input('pencarian')));
        }
        return view('modules.landing.katalog-buku', compact('listBuku'));
    }

    public function cekPeminjaman(Request $request)
    {
        $listPeminjaman = null;
        $dataHibah = null;
        $dataSuratBebasPerpusatakaan = null;
        if (!is_null($request->input('pencarian')))
        {
            try
            {
                $listPeminjaman = $this->historyPeminjamanService->dtPeminjamanBukuByIdSiswa($request->input('pencarian'));
                $dataHibah = $this->hibahBukuService->getHibahBukuByNomorInduk($request->input('pencarian'));
                $dataSuratBebasPerpusatakaan = $this->suratBebasPinjamService->getByNomorInduk($request->input('pencarian'));
            }
            catch (BusinessException $e)
            {
                return response()
                    ->redirectToRoute('cek-peminjaman')
                    ->with('error', $e->getMessage());
            }
        }
        return view('modules.landing.cek-peminjaman', compact('listPeminjaman','dataHibah','dataSuratBebasPerpusatakaan'));
    }

    public function downloadSuratBebasPinjamSiswa(string $nomorInduk)
    {
        $dataSuratBebasPerpusatakaan = $this->suratBebasPinjamService->getByNomorInduk($nomorInduk);
        return Storage::disk('s3')->download($dataSuratBebasPerpusatakaan->path_to_file);
    }
}
