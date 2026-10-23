<?php

namespace App\Http\Controllers\Modules\Kelulusan;

use App\Http\Controllers\Controller;
use App\Services\ProsesKelulusanService;
use Illuminate\Http\Request;

class UpdateKelulusan extends Controller
{
    public function __construct(
        private ProsesKelulusanService $prosesKelulusanService
    )
    {}

    public function __invoke(string $uuidTahunAjar)
    {
        $this->prosesKelulusanService->prosesKelulusan($uuidTahunAjar);
    }
}
