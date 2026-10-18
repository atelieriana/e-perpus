<?php

namespace App\Http\Requests\KodeKelas;

use App\Services\KejuruanService;
use App\Services\KelasService;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
{
    public function __construct(
        private KelasService $kelasService,
        private KejuruanService $kejuruanService
    )
    {
        parent::__construct();
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $dataKelas = $this->kelasService->findByUUID($this->post('uuid-kelas'));
        $dataKejuruan = $this->kejuruanService->findByUUID($this->post('uuid-kejuruan'));
        return [
            'uuid-kelas' => ['required','uuid'],
            'uuid-kejuruan' => ['required','uuid'],
            'kode-kelas' => [
                'required',
                'string',
                Rule::unique('ref_kode_kelas','kode_kelas')->where(function (Builder $query) use ($dataKelas, $dataKejuruan) {
                    $query->where('id_ref_kelas', $dataKelas->id)
                        ->where('id_ref_kejuruan', $dataKejuruan->id);
                })
            ],
            'deskripsi-kelas' => ['nullable','string'],
        ];
    }

    public function messages()
    {
        return [
            '*.required' => ':attribute wajib diisi.',
            '*.uuid' => ':attribute tidak valid.',
            '*.unique' => ':attribute telah digunakan.',
        ];
    }

    public function attributes()
    {
        return [
            'uuid-kelas' => 'Kelas',
            'uuid-kejuruan' => 'Kejuruan',
            'kode-kelas' => 'Kode kelas',
            'deskripsi' => 'Deskripsi',
        ];
    }
}
