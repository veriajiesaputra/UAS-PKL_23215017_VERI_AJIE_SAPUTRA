<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GejalaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        $gejalaId = $this->route('gejala')?->id;

        return [
            'kode_gejala' => [
                'required',
                'string',
                'max:20',
                Rule::unique('gejala', 'kode_gejala')->ignore($gejalaId),
            ],
            'nama_gejala' => ['required', 'string', 'max:255'],
        ];
    }

    public function attributes(): array
    {
        return [
            'kode_gejala' => 'kode gejala',
            'nama_gejala' => 'nama gejala',
        ];
    }
}
