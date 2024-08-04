<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DosenTetapPerguruanTinggiRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users'],
            'nama' => ['required'],
            'nidn' => ['required'],
            'pendidikan_magister' => ['required'],
            'pendidikan_doktor' => ['required'],
            'bidang_keahlian' => ['required'],
            'kesesuaian' => ['boolean'],
            'jabatan_akademik' => ['required'],
            'sertifikat_pendidik' => ['required'],
            'sertifikat_kompetensi' => ['required'],
            'mata_kuliah_ps_diakreditasi' => ['required'],
            'kesesuaian_bidang_keahlian' => ['required'],
            'mata_kuliah_ps_lain' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
