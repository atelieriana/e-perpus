<?php

namespace App\Http\Controllers\Modules\TahunAjar;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Requests\TahunAjar\CreateRequest;
use App\Services\TahunAjarServices;
use App\Traits\AuditAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CreateTahunAjar extends Controller
{
    use AuditAccess;
    private $moduleName = 'Tahun Ajar - Create';
    public function __construct(
        private TahunAjarServices $tahunAjarServices
    )
    {
        $this->logAccess();
    }

    public function index()
    {
        return view('modules.tahun-ajar.create');
    }

    public function onSubmit(CreateRequest $request)
    {
        $requestData = [
            'uuid' => Str::uuid()->toString(),
            'tahun_ajar' => $request->post('tahun-ajar'),
            'tanggal_mulai' => $request->post('tanggal-mulai'),
            'tanggal_akhir' => $request->post('tanggal-akhir'),
        ];

        try
        {
            $this->tahunAjarServices->createReccordTahunAjar($requestData);
        }
        catch (BusinessException $exception)
        {
            return response()
                ->redirectToRoute('tahun-ajar.create')
                ->with('error', $exception->getMessage());
        }

        return response()
            ->redirectToRoute('tahun-ajar.index')
            ->with('success', 'Tahun ajar berhasil ditambahkan');
    }
}
