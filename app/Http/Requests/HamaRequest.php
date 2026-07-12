<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HamaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->isStaff();
    }

    public function rules(): array
    {
        $hamaId = $this->route('hama')?->id;

        return [
            'kode_hama' => [
                'required',
                'string',
                'max:20',
                Rule::unique('hama', 'kode_hama')->ignore($hamaId),
            ],
            'nama_hama' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'solusi' => ['nullable', 'string'],
            'gambar' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
        ];
    }

    public function attributes(): array
    {
        return [
            'kode_hama' => 'kode hama',
            'nama_hama' => 'nama hama',
        ];
    }
}
