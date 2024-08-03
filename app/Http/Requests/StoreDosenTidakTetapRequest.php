<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDosenTidakTetapRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nama' => ['nullable'],
            'nidn' => ['nullable'],
            'pendidikan_terakhir' => ['nullable'],
            'bidang_keahlian' => ['nullable'],
            'jabatan' => ['nullable'],
            'sertifikat_pendidik' => ['nullable'],
            'sertifikat_kompetensi' => ['nullable'],
            'mata_kuliah' => ['nullable'],
            'kesesuaian_bidang' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
