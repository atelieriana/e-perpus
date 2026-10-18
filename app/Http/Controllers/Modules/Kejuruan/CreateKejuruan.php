<?php

namespace App\Http\Controllers\Modules\Kejuruan;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Kejuruan\CreateRequest;
use App\Services\KejuruanService;
use Illuminate\Support\Str;

class CreateKejuruan extends Controller
{
    public function __construct(
        private KejuruanService $kejuruanService
    )
    {}

    public function index()
    {
        return view('modules.kejuruan.create');
    }

    public function onSubmit(CreateRequest $request)
    {
        $requestData = [
            'uuid' => Str::uuid()->toString(),
            'kejuruan' => $request->post('kejuruan'),
        ];

        try
        {
            $this->kejuruanService->createRecordKejuruan($requestData);
            return response()
                ->redirectToRoute('kejuruan.index')
                ->with('success','Data kejuruan berhasil ditambahkan.');
        }
        catch (BusinessException $exception)
        {
            return response()
                ->redirectToRoute('kejuruan.create')
                ->with('error', $exception->getMessage());
        }
    }
}
