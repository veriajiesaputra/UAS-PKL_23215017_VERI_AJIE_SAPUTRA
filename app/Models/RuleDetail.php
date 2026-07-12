<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RuleDetail extends Model
{
    use HasFactory;

    protected $table = 'rule_details';

    protected $fillable = [
        'rule_id',
        'gejala_id',
        'nilai_cf',
    ];

    protected $casts = [
        'nilai_cf' => 'decimal:2',
    ];

    public function rule(): BelongsTo
    {
        return $this->belongsTo(Rule::class);
    }

    public function gejala(): BelongsTo
    {
        return $this->belongsTo(Gejala::class);
    }
}
