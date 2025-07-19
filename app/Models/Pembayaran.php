<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'id_tagihan',
        'tgl_bayar',
        'jumlah_bayar',
        'metode_pembayaran',
        'keterangan',
        'id_user',
    ];

    public function tagihan(): BelongsTo
    {
        return $this->belongsTo(TagihanSpp::class, 'id_tagihan');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
