<?php

namespace App\Http\Controllers\Modules\Kelulusan;

use App\Http\Controllers\Controller;
use App\Services\TahunAjarServices;

class IndexKelulusan extends Controller
{
    public function __construct(
        private TahunAjarServices $tahunAjarServices
    )
    {}

    public function index()
    {
        $listTahunAjar = $this->tahunAjarServices->getAllRecord();
        return view('modules.kelulusan.index', compact('listTahunAjar'));
    }
}
