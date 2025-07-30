<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Spp extends Model
{
    use HasFactory;

    protected $table = 'spp';

    protected $fillable = [
        'nis',
        'tahun',
        'nominal',
        'bulan',
        'status',
        'jatuh_tempo',
    ];

    public function tagihan(): HasMany
    {
        return $this->hasMany(TagihanSpp::class, 'id_spp');
    }
}
