<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DosenIndustriPraktisiRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nama' => 'nullable',
            'nidn'=> 'nullable',
            'perusahaan'=> 'nullable',
            'pendidikan_terakhir'=> 'nullable',
            'bidang_keahlian'=> 'nullable',
            'sertifikat_kompetensi'=> 'nullable',
            'mata_kuliah'=> 'nullable',
            'bobot_kredit'=> 'nullable',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
