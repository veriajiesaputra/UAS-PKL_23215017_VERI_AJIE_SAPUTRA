<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hama extends Model
{
    use HasFactory;

    protected $table = 'hama';

    protected $fillable = [
        'kode_hama',
        'nama_hama',
        'deskripsi',
        'solusi',
        'gambar',
    ];

    protected $appends = ['gambar_url'];

    public function getGambarUrlAttribute(): string
    {
        if ($this->gambar && file_exists(public_path($this->gambar))) {
            return asset($this->gambar);
        }

        return asset('assets/images/targets/default-hama.jpg');
    }

    public function rules(): HasMany
    {
        return $this->hasMany(Rule::class, 'target_id')->where('jenis', 'hama');
    }
}
