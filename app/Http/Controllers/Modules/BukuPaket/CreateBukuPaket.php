<?php

namespace App\Http\Controllers\Modules\BukuPaket;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Datatables\BukuPelajaran;
use App\Http\Requests\BukuPaket\CreateRequest;
use App\Services\BukuPaketService;
use App\Services\BukuService;
use App\Services\KejuruanService;
use App\Services\KelasService;
use App\Traits\AuditAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CreateBukuPaket extends Controller
{
    use AuditAccess;

    const BUKU_PELAJARAN = 2;
    private $moduleName = 'Buku Paket - Create';

    public function __construct(
        private bukuService $bukuService,
        private KelasService $kelasService,
        private KejuruanService $kejuruanService,
        private BukuPaketService $bukuPaketService,
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
        $dataKelas = $this->kelasService->findByUUID($request->post('uuid-kelas'));
        $dataKejuruan = $this->kejuruanService->findByUUID($request->post('uuid-kejuruan'));
        $dataBukuPaket = $this->bukuService->findDataBukuByUUID($request->post('uuid-buku-pelajaran'));

        if (is_null($dataBukuPaket) || is_null($dataKelas) || is_null($dataKejuruan)) {
            return response()
                ->redirectToRoute('buku-paket.create')
                ->with('error', 'Data yang dipilih tidak ditemukan.');
        }

        $requestData = [
            'uuid' => Str::uuid()->toString(),
            'id_ref_kelas' => $dataKelas->id,
            'id_ref_kejuruan' => $dataKejuruan->id,
            'id_ref_buku' => $dataBukuPaket->id,
        ];

        try
        {
            $this->bukuPaketService->createRecordBukuPaket($requestData);
        }
        catch (BusinessException $exception)
        {
            return response()
                ->redirectToRoute('buku-paket.create')
                ->withErrors($exception->getMessage());
        }

        return response()
            ->redirectToRoute('buku-paket.index')
            ->with('success','Buku paket berhasil ditambahkan.');
    }
}
