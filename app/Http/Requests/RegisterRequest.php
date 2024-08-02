<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'username' => ['required'],
            'password' => ['required'],
            'remember_token' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
