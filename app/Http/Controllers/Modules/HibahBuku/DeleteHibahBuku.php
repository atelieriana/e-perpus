<?php

namespace App\Http\Controllers\Modules\HibahBuku;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Requests\HibahBuku\DeleteRequest;
use App\Services\HibahBukuService;
use Illuminate\Http\Request;

class DeleteHibahBuku extends Controller
{
    public function __construct(
        private HibahBukuService $hibahBukuService
    )
    {}

    public function index(string $uuid)
    {
        $dataHibahBuku = $this->hibahBukuService->findHibahBuku($uuid);
        return view('modules.hibah-buku.delete', compact('dataHibahBuku'));
    }

    public function onSubmit(DeleteRequest $request)
    {
        try
        {
            $this->hibahBukuService->deleteRecordHibahBuku($request->validated());
            return response()
                ->redirectToRoute('hibah-buku.index')
                ->with('success', 'Berhasil menghapus hibah buku.');
        }
        catch (BusinessException $exception)
        {
            return response()
                ->redirectToRoute('hibah-buku.delete')
                ->with('error', $exception->getMessage());
        }
    }
}
