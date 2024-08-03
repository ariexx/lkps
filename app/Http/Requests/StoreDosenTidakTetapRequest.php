<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDosenTidakTetapRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nama' => ['string'],
            'nidn' => ['string'],
            'pendidikan_terakhir' => ['string'],
            'bidang_keahlian' => ['string'],
            'jabatan' => ['string'],
            'sertifikat_pendidik' => ['string'],
            'sertifikat_kompetensi' => ['string'],
            'mata_kuliah' => ['string'],
            'kesesuaian_bidang' => ['string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
