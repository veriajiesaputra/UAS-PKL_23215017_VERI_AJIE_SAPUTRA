<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rule extends Model
{
    use HasFactory;

    protected $table = 'rules';

    protected $fillable = [
        'jenis',
        'target_id',
    ];

    public const JENIS_PENYAKIT = 'penyakit';
    public const JENIS_HAMA = 'hama';

    public function details(): HasMany
    {
        return $this->hasMany(RuleDetail::class);
    }

    public function gejala(): BelongsToMany
    {
        return $this->belongsToMany(Gejala::class, 'rule_details')
            ->withPivot('nilai_cf')
            ->withTimestamps();
    }

    public function penyakit(): BelongsTo
    {
        return $this->belongsTo(Penyakit::class, 'target_id');
    }

    public function hama(): BelongsTo
    {
        return $this->belongsTo(Hama::class, 'target_id');
    }

    public function target()
    {
        return $this->jenis === self::JENIS_PENYAKIT
            ? $this->penyakit
            : $this->hama;
    }

    public function getTargetNameAttribute(): ?string
    {
        $target = $this->target();

        if (! $target) {
            return null;
        }

        return $this->jenis === self::JENIS_PENYAKIT
            ? $target->nama_penyakit
            : $target->nama_hama;
    }

    public function getTargetCodeAttribute(): ?string
    {
        $target = $this->target();

        if (! $target) {
            return null;
        }

        return $this->jenis === self::JENIS_PENYAKIT
            ? $target->kode_penyakit
            : $target->kode_hama;
    }
}
