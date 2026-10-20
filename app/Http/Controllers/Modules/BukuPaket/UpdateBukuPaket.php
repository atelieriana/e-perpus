<?php

namespace App\Http\Controllers\Modules\BukuPaket;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Requests\BukuPaket\UpdateRequest;
use App\Services\BukuPaketService;
use App\Services\BukuService;
use App\Services\KejuruanService;
use App\Services\KelasService;
use App\Traits\AuditAccess;
use Illuminate\Http\RedirectResponse;
use function PHPUnit\Framework\isNull;

class UpdateBukuPaket extends Controller
{
    use AuditAccess;

    const BUKU_PELAJARAN = 2;
    private $moduleName = 'Buku Paket - Update';

    public function __construct(
        private BukuPaketService $bukuPaketService,
        private BukuService $bukuService,
        private KelasService $kelasService,
        private KejuruanService $kejuruanService
    )
    {
        $this->logAccess();
    }

    public function index(string $uuid)
    {
        $dataBukuPaket = $this->bukuPaketService->findByUUID($uuid);
        $listKelas = $this->kelasService->getAllRecord();
        $listKejuruan = $this->kejuruanService->getAllRecord();
        $listBuku = $this->bukuService->getBukuByJenisBuku(self::BUKU_PELAJARAN);
        return view('modules.buku-paket.update', compact(
            'dataBukuPaket',
            'listKelas',
            'listKejuruan',
            'listBuku',
        ));
    }

    public function onSubmit(UpdateRequest $request)
    {
        $originalUUID = getOriginalUUID();
        $dataBukuPaket = $this->bukuPaketService->findByUUID($request->post('uuid-buku-paket'));
        $dataKelas = $this->kelasService->findByUUID($request->post('uuid-kelas'));
        $dataKejuruan = $this->kejuruanService->findByUUID($request->post('uuid-kejuruan'));
        $dataBuku = $this->bukuService->findDataBukuByUUID($request->post('uuid-buku-pelajaran'));

        $this->validateDataAndOrigin($dataBukuPaket, $originalUUID);

        $requestData = [
            'id_ref_kelas' => $dataKelas->id,
            'id_ref_kejuruan' => $dataKejuruan->id,
            'id_ref_buku' => $dataBuku->id,
        ];

        try
        {
            $this->bukuPaketService->updateRecordBukuPaket($requestData, $dataBukuPaket->id);
        }
        catch (BusinessException $exception)
        {
            return response()
                ->redirectToRoute('buku-paket.update', ['uuid' => $request->post('uuid-buku')])
                ->with('error', $exception->getMessage());
        }

        return response()
            ->redirectToRoute('buku-paket.index')
            ->with('success', 'Buku Paket Berhasil Diupdate.');
    }

    /**
     * @param array $dataBukuPaket
     * @param string $uuid
     * @return RedirectResponse|void
     */
    private function validateDataAndOrigin(object $dataBukuPaket, string $uuid)
    {
        if (is_null($dataBukuPaket)) {
            return response()
                ->redirectToRoute('buku-paket.update', ['uuid' => $uuid])
                ->with('error','Data buku paket tidak tersedia');
        }

        if ($dataBukuPaket->uuid !== $uuid) {
            return response()
                ->redirectToRoute('buku-paket.update', ['uuid' => $uuid])
                ->with('error','UUID telah diubah');
        }
    }
}
