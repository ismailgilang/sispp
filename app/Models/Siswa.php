<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Siswa extends Model
{
     use HasFactory;

    protected $table = 'siswa';
    protected $primaryKey = 'nis';
    public $incrementing = false; // karena primary key bukan auto-increment
    protected $keyType = 'string';

    protected $fillable = [
        'nis',
        'user_id',
        'nama',
        'id_kelas',
        'alamat',
        'no_telp',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function tagihan(): HasMany
    {
        return $this->hasMany(TagihanSpp::class, 'nis');
    }
}
