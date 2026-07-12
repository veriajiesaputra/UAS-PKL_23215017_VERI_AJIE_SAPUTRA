<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PenyakitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->isStaff();
    }

    public function rules(): array
    {
        $penyakitId = $this->route('penyakit')?->id;

        return [
            'kode_penyakit' => [
                'required',
                'string',
                'max:20',
                Rule::unique('penyakit', 'kode_penyakit')->ignore($penyakitId),
            ],
            'nama_penyakit' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'solusi' => ['nullable', 'string'],
            'gambar' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
        ];
    }

    public function attributes(): array
    {
        return [
            'kode_penyakit' => 'kode penyakit',
            'nama_penyakit' => 'nama penyakit',
        ];
    }
}
