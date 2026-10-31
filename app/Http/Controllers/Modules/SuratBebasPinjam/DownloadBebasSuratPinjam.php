<?php

namespace App\Http\Controllers\Modules\SuratBebasPinjam;

use App\Http\Controllers\Controller;
use App\Services\SuratBebasPinjamService;
use Illuminate\Support\Facades\Storage;

class DownloadBebasSuratPinjam extends Controller
{
    public function __construct(
        private SuratBebasPinjamService $suratBebasPinjamService
    )
    {}

    public function __invoke(string $uuid)
    {
        $dataSuratBebasPinjam = $this->suratBebasPinjamService->findByUUID($uuid);
        return Storage::disk('s3')->download($dataSuratBebasPinjam->path_to_file);
    }
}