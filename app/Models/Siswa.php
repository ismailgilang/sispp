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
        'nama',
        'id_kelas',
        'alamat',
        'no_telp',
        'nama_ibu',
        'nama_ayah'
    ];

    public function tagihan(): HasMany
    {
        return $this->hasMany(TagihanSpp::class, 'nis');
    }
    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    protected static function booted()
    {
        static::deleting(function ($siswa) {
            User::where('nis', $siswa->nis)->delete();
        });
    }
}
