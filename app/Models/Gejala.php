<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gejala extends Model
{
    use HasFactory;

    protected $table = 'gejala';

    protected $fillable = [
        'kode_gejala',
        'nama_gejala',
    ];

    public function ruleDetails(): HasMany
    {
        return $this->hasMany(RuleDetail::class);
    }

    public function rules(): BelongsToMany
    {
        return $this->belongsToMany(Rule::class, 'rule_details')
            ->withPivot('nilai_cf')
            ->withTimestamps();
    }
}
