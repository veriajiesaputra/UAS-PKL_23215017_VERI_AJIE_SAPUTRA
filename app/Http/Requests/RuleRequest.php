<?php

namespace App\Http\Requests;

use App\Models\Hama;
use App\Models\Penyakit;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RuleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'jenis' => ['required', Rule::in(['penyakit', 'hama'])],
            'target_id' => ['required', 'integer', 'min:1'],
            'gejala' => ['required', 'array', 'min:1'],
            'gejala.*.id' => ['required', 'integer', 'exists:gejala,id'],
            'gejala.*.nilai_cf' => ['required', 'numeric', 'min:0', 'max:1'],
        ];
    }

    public function attributes(): array
    {
        return [
            'jenis' => 'jenis',
            'target_id' => 'target',
            'gejala' => 'gejala',
            'gejala.*.id' => 'gejala',
            'gejala.*.nilai_cf' => 'nilai CF',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $jenis = $this->input('jenis');
            $targetId = $this->input('target_id');

            if (! $jenis || ! $targetId) {
                return;
            }

            $exists = $jenis === 'penyakit'
                ? Penyakit::whereKey($targetId)->exists()
                : Hama::whereKey($targetId)->exists();

            if (! $exists) {
                $validator->errors()->add('target_id', 'Target yang dipilih tidak ditemukan.');
            }

            $gejala = collect($this->input('gejala', []));
            $ids = $gejala->pluck('id')->filter()->all();

            if (count($ids) !== count(array_unique($ids))) {
                $validator->errors()->add('gejala', 'Tidak boleh ada gejala yang dipilih lebih dari satu kali.');
            }
        });
    }

    /**
     * Returns the normalized gejala rows ready to upsert.
     *
     * @return array<int, array{gejala_id: int, nilai_cf: float}>
     */
    public function normalizedGejala(): array
    {
        return collect($this->input('gejala', []))
            ->map(fn (array $row): array => [
                'gejala_id' => (int) $row['id'],
                'nilai_cf' => (float) $row['nilai_cf'],
            ])
            ->values()
            ->all();
    }
}
