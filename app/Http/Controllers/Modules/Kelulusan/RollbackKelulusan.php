<?php

namespace App\Http\Controllers\Modules\Kelulusan;

use App\Http\Controllers\Controller;
use App\Services\ProsesKelulusanService;

class RollbackKelulusan extends Controller
{
    public function __construct(
        private ProsesKelulusanService $prosesKelulusanService
    )
    {}

    public function __invoke(string $uuidTahunAjar)
    {
        $this->prosesKelulusanService->rollbackProsesKelulusan($uuidTahunAjar);
    }
}