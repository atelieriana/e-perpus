<?php

namespace App\Http\Controllers\Modules\Kejuruan;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Kejuruan\UpdateRequest;
use App\Services\KejuruanService;
use Illuminate\Http\RedirectResponse;

class UpdateKejuruan extends Controller
{
    public function __construct(
        private KejuruanService $kejuruanService
    )
    {}

    public function index(string $uuid)
    {
        $dataKejuruan = $this->kejuruanService->findByUUID($uuid);
        if (is_null($dataKejuruan)) {
            return response()
                ->redirectToRoute('kejuruan.index')
                ->with('error', 'Data kejuruan tidak ditemukan.');
        }

        return view('modules.kejuruan.update', compact('dataKejuruan'));
    }

    public function onSubmit(UpdateRequest $request)
    {
        $originalUUID = getOriginalUUID();
        $dataKejuruan = $this->kejuruanService->findByUUID($request->post('uuid'));

        $this->validateDataAndOrigins($dataKejuruan, $originalUUID);

        $requestUpdate = [
            'uuid' => $request->post('uuid'),
            'kejuruan' => $request->post('kejuruan'),
        ];

        try
        {
            $this->kejuruanService->updateRecordKejuruan($requestUpdate, $dataKejuruan->id);
            return response()
                ->redirectToRoute('kejuruan.index')
                ->with('success', 'Data kejuruan berhasil diubah.');
        }
        catch (BusinessException $exception)
        {
            return response()
                ->redirectToRoute('kejuruan.update', ['uuid' => $originalUUID])
                ->with('error', $exception->getMessage());
        }
    }

    /**
     * Digunakan untuk melakukan pengecekan validitas data dan UUID
     * @param $dataKejuruan
     * @param $originalUUID
     * @return RedirectResponse|void
     */
    private function validateDataAndOrigins($dataKejuruan, $originalUUID)
    {
        if (is_null($dataKejuruan)) {
            return response()
                ->redirectToRoute('kejuruan.index')
                ->with('error', 'Data kejuruan tidak ditemukan.');
        }

        if ($originalUUID !== $dataKejuruan->uuid) {
            return response()
                ->redirectToRoute('kejuruan.update', ['uuid' => $originalUUID])
                ->with('error', 'Data UUID telah diubah.');
        }
    }
}
