<?php

namespace App\Http\Controllers\Modules\KenaikanKelas;

use App\Http\Controllers\Controller;
use App\Services\KenaikanKelasService;
use App\Services\ProsesKenaikanKelasSiswaService;
use App\Services\TahunAjarServices;
use Illuminate\Http\Request;

class UpdateKenaikanKelas extends Controller
{
    public function __construct(
        private ProsesKenaikanKelasSiswaService $prosesKenaikanKelasSiswaService
    )
    {}

    public function __invoke(Request $request)
    {
        $uuidRefKelas = $request->input('uuid-ref-kelas');
        $this->prosesKenaikanKelasSiswaService->prosesKenaikanKelasSiswa($uuidRefKelas);
    }
}
