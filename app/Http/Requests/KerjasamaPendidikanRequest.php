<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KerjasamaPendidikanRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'lembaga_mitra' => ['required'],
            'internasional' => ['boolean'],
            'nasional' => ['boolean'],
            'lokal' => ['boolean'],
            'manfaat_ps_diakreditasi' => ['required'],
            'bukti_kerjasama' => ['required'],
            'tahun_berakhir_kerjasama' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
