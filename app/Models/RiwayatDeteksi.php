<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatDeteksi extends Model
{
    use HasFactory;

    protected $table = 'riwayat_deteksi';

    protected $fillable = [
        'user_id',
        'nama_pengguna',
        'jenis_hasil',
        'target_id',
        'nama_target',
        'kode_target',
        'nilai_cf',
        'gejala_terpilih',
        'ip_address',
    ];

    protected function casts(): array
    {
        return [
            'nilai_cf' => 'float',
            'gejala_terpilih' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getPersentaseCfAttribute(): float
    {
        return round($this->nilai_cf * 100, 1);
    }

    public function getPenggunaLabelAttribute(): string
    {
        if ($this->user) {
            return $this->user->name;
        }

        return $this->nama_pengguna ?: 'Tamu';
    }
}
