<?php

namespace App\Http\Controllers\Modules\Kejuruan;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Kejuruan\DeleteRequest;
use App\Services\KejuruanService;

class DeleteKejuruan extends Controller
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
                ->with('error','Data kejuruan tidak ditemukan.');
        }
        return view('modules.kejuruan.delete', compact('dataKejuruan'));
    }

    public function onSubmit(DeleteRequest $request)
    {
        $originalUUID = getOriginalUUID();
        $dataKejuruan = $this->kejuruanService->findByUUID($request->post('uuid'));
        $this->validateDataandOrigins($dataKejuruan, $originalUUID);

        try
        {
            $this->kejuruanService->deleteRecordKejuruan($dataKejuruan->id);
        }
        catch (BusinessException $exception)
        {
            return response()
                ->redirectToRoute('kejuruan.delete', ['uuid' => $originalUUID])
                ->with('error', $exception->getMessage());
        }

        return response()
            ->redirectToRoute('kejuruan.index')
            ->with('success','Data kejuruan telah berhasil dihapus.');
    }

    private function validateDataandOrigins($dataKejuruan, $originalUUID)
    {
        if (is_null($dataKejuruan)) {
            return response()
                ->redirectToRoute('kejuruan.delete', ['uuid' => $originalUUID])
                ->with('error','Data kejuruan tidak ditemukan.');
        }

        if ($originalUUID !== $dataKejuruan->uuid) {
            return response()
                ->redirectToRoute('kejuruan.delete', ['uuid' => $dataKejuruan->uuid])
                ->with('error','UUID telah diubah');
        }
    }
}
