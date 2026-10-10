<?php

namespace App\Http\Controllers\Modules\BukuUmum;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Requests\BukuUmum\UpdateRequest;
use App\Services\BukuService;
use App\Services\UploadService;
use App\Traits\AuditAccess;
use Carbon\Carbon;
use Illuminate\Support\Str;

class UpdateBukuUmum extends Controller
{
    use AuditAccess;

    private $moduleName = 'Buku Umum - Update';
    const JENIS_BUKU_PELAJARAN = 1;
    const DIRECTORY_NAME = 'cover-buku-umum'
    ;
    public function __construct(
        private BukuService $bukuService,
        private UploadService $uploadService,
    )
    {
        $this->logAccess();
    }

    public function index(string $uuid)
    {
        $dataBuku = $this->bukuService->findDataBukuByUUID($uuid);
        return view('modules.buku-umum.update',compact('dataBuku'));
    }

    public function onSubmit(UpdateRequest $request)
    {
        $currentDate = explode('-',Carbon::now()->format('Y-m-d'));
        $directory = self::DIRECTORY_NAME.'/'.$currentDate[0].'/'.$currentDate[1].'/'.$currentDate[2];
        $dataBuku = $this->bukuService->findDataBukuByUUID($request->post('uuid-buku'));
        try
        {
            $requestData = [
                'judul' => $request->post('judul'),
                'kota_terbit' => $request->post('kota-terbit'),
                'penerbit' => $request->post('penerbit'),
                'penulis' => $request->post('penulis'),
                'tahun_terbit' => $request->post('tahun-terbit'),
                'isbn' => $request->post('isbn'),
                'halaman' => $request->post('halaman'),
                'deskripsi_fisik' => $request->post('deskripsi-fisik'),
                'jumlah_buku' => $request->post('jumlah-buku'),
                'id_ref_jenis_buku' => self::JENIS_BUKU_PELAJARAN,
            ];
            if (!is_null($request->file('cover-buku')))
            {
                $pathFile = $this->uploadService->upload($directory, $request->file('cover-buku'));
                $requestData['file_cover'] = $pathFile;
            }

            $this->bukuService->updateRecordBuku($requestData, $dataBuku->id);
        }
        catch (BusinessException $exception)
        {
            return response()
                ->redirectToRoute('buku-umum.update', ['uuid' => $dataBuku->uuid])
                ->with('error', $exception->getMessage());
        }

        return response()
            ->redirectToRoute('buku-umum.index')
            ->with('success', 'BukuUmum umum berhasil dilakukan perubahan.');
    }
}