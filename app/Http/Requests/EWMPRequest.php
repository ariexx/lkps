<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EWMPRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'dtps' => ['boolean'],
            'ps_diakreditasi' => ['required', 'integer'],
            'ps_lain_didalam_pt' => ['required', 'integer'],
            'pt_lain_diluar_pt' => ['required', 'integer'],
            'penelitian' => ['required', 'integer'],
            'pkm' => ['required', 'integer'],
            'tugas_tambahan' => ['required', 'integer'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
