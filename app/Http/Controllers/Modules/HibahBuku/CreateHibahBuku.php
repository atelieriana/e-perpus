<?php

namespace App\Http\Controllers\Modules\HibahBuku;

use App\Http\Controllers\Controller;
use App\Http\Requests\HibahBuku\CreateRequest;
use App\Services\KejuruanService;
use App\Services\KelasService;
use App\Services\TahunAjarServices;
use Illuminate\Http\Request;

class CreateHibahBuku extends Controller
{
    public function __construct(
        private KejuruanService $kejuruanService,
        private TahunAjarServices $tahunAjarService,
    )
    {}

    public function index()
    {
        $listKejuruan = $this->kejuruanService->getAllRecord();
        $listTahunAjar = $this->tahunAjarService->getAllRecord();
        return view('modules.hibah-buku.create', compact('listKejuruan','listTahunAjar'));
    }

    public function onSubmit(CreateRequest $request)
    {

    }
}
