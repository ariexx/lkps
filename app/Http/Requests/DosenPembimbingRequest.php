<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DosenPembimbingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users'],
            'name' => ['required'],
            'jumlah_mahasiswa_dibimbing_ts' => ['required', 'integer'],
            'jumlah_mahasiswa_dibimbing_ts1' => ['required', 'integer'],
            'jumlah_mahasiswa_dibimbing_ts2' => ['required', 'integer'],
            'rata_rata_mahasiswa' => ['required', 'numeric'],
            'jumlah_mahasiswa_dibimbing_ts_lain' => ['required'],
            'jumlah_mahasiswa_dibimbing_ts1_lain' => ['required'],
            'jumlah_mahasiswa_dibimbing_ts2_lain' => ['required'],
            'rata_rata_mahasiswa_lain' => ['required', 'numeric'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
