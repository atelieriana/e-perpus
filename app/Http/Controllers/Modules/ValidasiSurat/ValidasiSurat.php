<?php

namespace App\Http\Controllers\Modules\ValidasiSurat;

use App\Http\Controllers\Controller;
use App\Services\SuratBebasPinjamService;
use Illuminate\Support\Facades\Storage;

class ValidasiSurat extends Controller
{
    public function __construct(
        private SuratBebasPinjamService $suratBebasPinjamService
    )
    {}

    public function __invoke(string $uuidSuratBebasPinjam)
    {
        $dataSuratBebasPinjam = $this->suratBebasPinjamService->findByUUID($uuidSuratBebasPinjam);
        $disk = Storage::disk('s3');
        $stream = $disk->readStream($dataSuratBebasPinjam->path_to_file);
        $mimeType = $disk->mimeType($dataSuratBebasPinjam->path_to_file);
        $filenameOriginal = basename($dataSuratBebasPinjam->path_to_file);

        return response()->stream(function() use ($stream) {
            fpassthru($stream);
            if (is_resource($stream)) {
                fclose($stream);
            }
        }, 200, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . $filenameOriginal . '"',
        ]);
    }
}