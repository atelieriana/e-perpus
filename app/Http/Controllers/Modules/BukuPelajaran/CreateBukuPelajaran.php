<?php

namespace App\Http\Controllers\Modules\BukuPelajaran;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Requests\BukuPelajaranCreateRequest;
use App\Services\BukuService;

class CreateBukuPelajaran extends Controller
{
    public function __construct(
        private BukuService $bukuService,
    )
    {}

    public function index()
    {
        return view('modules.buku-pelajaran.create');
    }

    public function onSubmit(BukuPelajaranCreateRequest $request)
    {
        try
        {
            return '';
        }
        catch (BusinessException $exception)
        {
            return response()
                ->redirectToRoute('buku-pelajaran.buku.create.submit')
                ->with('error', $exception->getMessage());
        }
    }
}