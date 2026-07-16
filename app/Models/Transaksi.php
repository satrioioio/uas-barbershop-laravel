<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    /**
     * Primary key.
     */
    protected $primaryKey = 'id_transaksi';

    /**
     * Kolom yang bisa diisi massal.
     */
    protected $fillable = [
        'id_user',
        'id_layanan',
        'metode_pembayaran',
        'bukti_foto_qris',
        'waktu_transaksi',
    ];

    /**
     * Cast kolom waktu_transaksi sebagai datetime.
     */
    protected $casts = [
        'waktu_transaksi' => 'datetime',
    ];

    /**
     * Relasi: Transaksi dimiliki oleh satu User (Capster).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    /**
     * Relasi: Transaksi dimiliki oleh satu Layanan.
     */
    public function layanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class, 'id_layanan', 'id_layanan');
    }
}
