<?php

namespace App\Http\Controllers\Modules\BukuPelajaran;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Requests\BukuPelajaranCreateRequest;
use App\Services\BukuService;
use App\Services\UploadService;
use App\Traits\AuditAccess;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateBukuPelajaran extends Controller
{
    use AuditAccess;
    private $moduleName = 'Buku Pelajaran - Create';
    const JENIS_BUKU_PELAJARAN = 2;

    public function __construct(
        private BukuService $bukuService,
        private UploadService $uploadService,
    )
    {
        $this->logAccess();
    }

    public function index()
    {
        return view('modules.buku-pelajaran.create');
    }

    public function onSubmit(BukuPelajaranCreateRequest $request)
    {
        $currentDate = explode('-',Carbon::now()->format('Y-m-d'));
        $directory = $currentDate[0].'/'.$currentDate[1].'/'.$currentDate[2].'buku-pelajaran';

        DB::beginTransaction();
        try
        {
            $pathFile = $this->uploadService->upload($directory, $request->file('cover-buku'));
            $requestData = [
                'uuid' => Str::uuid()->toString(),
                'judul' => $request->post('judul'),
                'kota_terbit' => $request->post('kota-terbit'),
                'penerbit' => $request->post('penerbit'),
                'penulis' => $request->post('penulis'),
                'tahun_terbit' => $request->post('tahun-terbit'),
                'isbn' => $request->post('isbn'),
                'halaman' => $request->post('halaman'),
                'deskripsi_fisik' => $request->post('deskripsi-fisik'),
                'jumlah_buku' => $request->post('jumlah-buku'),
                'file_cover' => $pathFile,
                'id_ref_jenis_buku' => self::JENIS_BUKU_PELAJARAN,
            ];
            $this->bukuService->createRecordBuku($requestData);
            DB::commit();
        }
        catch (BusinessException $exception)
        {
            DB::rollBack();
            return response()
                ->redirectToRoute('buku-pelajaran.buku.create')
                ->with('error', $exception->getMessage());
        }

        return response()
            ->redirectToRoute('buku-pelajaran.buku.index')
            ->with('success', 'Buku Pelajaran Berhasil Dibuat');
    }
}