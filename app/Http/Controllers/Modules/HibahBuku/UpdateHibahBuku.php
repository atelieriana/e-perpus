<?php

namespace App\Http\Controllers\Modules\HibahBuku;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Requests\HibahBuku\UpdateRequest;
use App\Services\BukuService;
use App\Services\HibahBukuService;
use App\Services\KejuruanService;
use App\Services\KelasService;
use App\Services\KodeKelasService;
use App\Services\PenempatanSiswaService;
use App\Services\TahunAjarServices;
use App\Services\UploadService;
use Carbon\Carbon;

class UpdateHibahBuku extends Controller
{
    private $moduleName = 'Buku Umum - Update';
    const JENIS_BUKU_UMUM = 1;
    const DIRECTORY_NAME = 'cover-buku-umum';

    public function __construct(
        private KelasService $kelasService,
        private HibahBukuService $hibahBukuService,
        private KejuruanService $kejuruanService,
        private TahunAjarServices $tahunAjarService,
        private KodeKelasService $kodeKelasService,
        private PenempatanSiswaService $penempatanSiswaService,
        private BukuService $bukuService,
        private UploadService $uploadService,
    )
    {}

    public function index(string $uuidHibahBuku)
    {
        $dataBukuHibah = $this->hibahBukuService->findHibahBuku($uuidHibahBuku);
        $listKelas = $this->kelasService->getAllRecord();
        $listTahunAjar = $this->tahunAjarService->getAllRecord();
        $listKejuruan = $this->kejuruanService->getAllRecord();
        $listKodeKelas = $this->kodeKelasService->getKodeKelasByKelasAndKejuruan(
            $dataBukuHibah->ref_siswa->trans_penempatan_latest->ref_kode_kelas->ref_kelas->id,
            $dataBukuHibah->ref_siswa->trans_penempatan_latest->ref_kode_kelas->ref_kejuruan->id
        );
        $listSiswa = $this->penempatanSiswaService->getSiswaByKodeKelasDanTahunAjar(
            $dataBukuHibah->ref_siswa->trans_penempatan_latest->ref_kode_kelas->uuid,
            $dataBukuHibah->ref_siswa->trans_penempatan_latest->ref_tahun_ajar->uuid
        );
        return view('modules.hibah-buku.update',
            compact('dataBukuHibah', 'listKelas','listTahunAjar','listKejuruan','listKodeKelas','listSiswa'));
    }

    public function onSubmit(UpdateRequest $request)
    {
        $currentDate = explode('-',Carbon::now()->format('Y-m-d'));
        $directory = self::DIRECTORY_NAME.'/'.$currentDate[0].'/'.$currentDate[1].'/'.$currentDate[2];
        try
        {
            $requestData = [
                'uuid-ref-siswa' => $request->post('uuid-ref-siswa'),
                'uuid-ref-buku' => $request->post('uuid-ref-buku'),
                'uuid-trans-hibah' => $request->post('uuid-trans-hibah'),
                'judul' => $request->post('judul'),
                'kota_terbit' => $request->post('kota-terbit'),
                'penerbit' => $request->post('penerbit'),
                'penulis' => $request->post('penulis'),
                'tahun_terbit' => $request->post('tahun-terbit'),
                'isbn' => $request->post('isbn'),
                'halaman' => $request->post('halaman'),
                'deskripsi_fisik' => $request->post('deskripsi-fisik'),
                'jumlah_buku' => $request->post('jumlah-buku'),
                'id_ref_jenis_buku' => self::JENIS_BUKU_UMUM,
            ];
            if (!is_null($request->file('cover-buku')))
            {
                $pathFile = $this->uploadService->upload($directory, $request->file('cover-buku'));
                $requestData['file_cover'] = $pathFile;
            }

            $this->hibahBukuService->updateRecordHibahBuku($requestData);

            return response()
                ->redirectToRoute('hibah-buku.index')
                ->with('success','Berhasil update data hibah buku.');
        }
        catch (BusinessException $exception)
        {
            return response()
                ->redirectToRoute('hibah-buku.update', ['uuid' => $request->post('uuid-trans-hibah')])
                ->with('error', $exception->getMessage())
                ->withInput();
        }
    }
}
