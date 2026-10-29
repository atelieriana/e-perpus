<?php

namespace App\Http\Controllers\Modules\HibahBuku;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Requests\HibahBuku\CreateRequest;
use App\Services\BukuService;
use App\Services\HibahBukuService;
use App\Services\KejuruanService;
use App\Services\KodeKelasService;
use App\Services\SiswaService;
use App\Services\TahunAjarServices;
use App\Services\UploadService;
use App\Traits\AuditAccess;
use Carbon\Carbon;
use Illuminate\Support\Str;

class CreateHibahBuku extends Controller
{
    use AuditAccess;
    private $moduleName = 'Hibah Buku - Create';
    const JENIS_BUKU_UMUM = 1;
    const KELAS_XII = 3;
    const UUID_REF_KELAS = 'a4f8318f-3045-41a6-9101-ab2f2699b169';
    const DIRECTORY_NAME = 'cover-buku-umum';

    public function __construct(
        private KejuruanService $kejuruanService,
        private TahunAjarServices $tahunAjarService,
        private HibahBukuService $hibahBukuService,
        private KodeKelasService $kodeKelasService,
        private BukuService $bukuService,
        private UploadService $uploadService,
        private SiswaService $siswaService,
    )
    {}

    public function index()
    {
        $listKejuruan = $this->kejuruanService->getAllRecord();
        $listTahunAjar = $this->tahunAjarService->getAllRecord();
        $listKodeKelas = null;
        $listSiswa = null;
        if (!is_null(old('kode-kelas')))
        {
            $dataKejuruan = $this->kejuruanService->findByUUID(old('kejuruan'));
            $listKodeKelas = $this->kodeKelasService->getKodeKelasByKelasAndKejuruan(self::KELAS_XII, $dataKejuruan->id);
        }
        if (!is_null(old('uuid-ref-siswa')))
        {
            $listSiswa = $this->siswaService->getSiswaByKelasKejuruanDanTahunAjar(self::UUID_REF_KELAS, old('kejuruan'),old('tahun-ajar'));
        }
        return view('modules.hibah-buku.create', compact('listKejuruan','listTahunAjar','listKodeKelas','listSiswa'));
    }

    public function onSubmit(CreateRequest $request)
    {
        $currentDate = explode('-',Carbon::now()->format('Y-m-d'));
        $directory = self::DIRECTORY_NAME.'/'.$currentDate[0].'/'.$currentDate[1].'/'.$currentDate[2];
        try
        {
            if (!is_null($request->file('cover-buku')))
            {
                $requestData['file_cover'] = $this->uploadService->upload($directory, $request->file('cover-buku'));
            }
            else
            {
                $requestData['file_cover'] = null;
            }
            $requestData = array_merge($requestData, $request->validated());
            $this->hibahBukuService->createRecordHibahBuku($requestData);

            return response()
                ->redirectToRoute('hibah-buku.index')
                ->with('success','Berhasil membuat hibah buku.');
        }
        catch (BusinessException $exception)
        {
            return response()
                ->redirectToRoute('hibah-buku.create')
                ->with('error', $exception->getMessage())
                ->withInput();
        }
    }
}
