<?php

namespace App\Http\Controllers\Modules\SuratBebasPinjam;

use App\Http\Controllers\Controller;
use App\Services\SiswaService;
use App\Services\SuratBebasPinjamService;
use Carbon\Carbon;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\Exception\CopyFileException;
use PhpOffice\PhpWord\Exception\CreateTemporaryFileException;
use PhpOffice\PhpWord\TemplateProcessor;
use Symfony\Component\Process\Process;

class CetakBebasSuratPinjam extends Controller
{
    const DIRECTORY_NAME = 'surat-bebas-perpus';

    public function __construct(
        private SuratBebasPinjamService $suratBebasPinjamService,
        private SiswaService $siswaService,
    )
    {}

    /**
     * @throws CopyFileException
     * @throws CreateTemporaryFileException
     */
    public function __invoke(string $uuidSuratBebasPinjam)
    {
        Carbon::setLocale('id');
        $dataBebasPinjam = $this->suratBebasPinjamService->findByUUID($uuidSuratBebasPinjam);
        $dataSiswa = $this->siswaService->getLatestKelasSiswa($dataBebasPinjam->id_ref_siswa);

        $fileLocation = storage_path('template/surat-bebas-perpus.docx');
        $templateProcessor = new TemplateProcessor($fileLocation);
        $templateProcessor->setValue('nama_siswa', $dataSiswa->nama_lengkap);
        $templateProcessor->setValue('nomor_induk_siswa', $dataSiswa->nomor_induk);
        $templateProcessor->setValue('kelas_siswa', $dataSiswa->kelas.' '.$dataSiswa->kode_kelas);
        $templateProcessor->setValue('jenis_bebas_pinjam', $dataBebasPinjam->ref_jenis_bebas_pinjam->jenis_bebas_pinjam);
        $templateProcessor->setValue('tanggal_surat', Carbon::parse($dataBebasPinjam->tanggal_surat)->translatedFormat('d F Y'));

        $qrCodeData = route('validasi-surat',['uuid'=>$uuidSuratBebasPinjam]);

        $result = (new Builder(
            writer: new PngWriter(),
            data: $qrCodeData,
            size: 300,
            margin: 10
        ))->build();

        $qrPath = storage_path('generated/'. uniqid() . '.png');
        $result->saveToFile($qrPath);

        $templateProcessor->setImageValue('generated_qr_code', [
            'path'   => $qrPath,
            'width'  => 120,
            'height' => 120,
            'ratio'  => false,
        ]);

        if (ob_get_contents()) {
            ob_end_clean();
        }
        flush();

        // Generate docx
        $currentDate = explode('-',Carbon::now()->format('Y-m-d'));
        $filenameDocx = self::DIRECTORY_NAME.'/'.$currentDate[0].'/'.$currentDate[1].'/'.$currentDate[2].'/'.$uuidSuratBebasPinjam.'.docx';
        $filenamePdf = self::DIRECTORY_NAME.'/'.$currentDate[0].'/'.$currentDate[1].'/'.$currentDate[2].'/'.$uuidSuratBebasPinjam.'.pdf';
        $templateProcessor->saveAs(storage_path('generated/'. $uuidSuratBebasPinjam . '.docx'));
        Storage::disk('s3')->put($filenameDocx,file_get_contents(storage_path('generated/'. $uuidSuratBebasPinjam . '.docx')));

        // Generate PDF
        $process = new Process([
            'soffice',
            '--headless',
            '--convert-to', 'pdf',
            '--outdir', storage_path('generated'),
            storage_path('generated/'. $uuidSuratBebasPinjam . '.docx'),
        ], null, [
            'HOME' => '/tmp',
        ]);
        $process->setTimeout(60);
        $process->run();

        if (!$process->isSuccessful() || !file_exists(storage_path('generated/'. $uuidSuratBebasPinjam . '.pdf'))) {
            abort(500, 'PDF conversion failed: ' . $process->getErrorOutput());
        }
        Storage::disk('s3')->put($filenamePdf,file_get_contents(storage_path('generated/'. $uuidSuratBebasPinjam . '.pdf')));

        unlink($qrPath);
        unlink(storage_path('generated/'. $uuidSuratBebasPinjam.'.docx'));
        unlink(storage_path('generated/'. $uuidSuratBebasPinjam.'.pdf'));

        // 3. Download
        return response()
            ->redirectToRoute('surat-bebas-perpus.index')
            ->with('success','Surat bebas pinjam berhasil digenerate.');
    }
}
