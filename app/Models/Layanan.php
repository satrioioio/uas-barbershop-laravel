<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Layanan extends Model
{
    /**
     * Primary key (string, bukan auto-increment).
     */
    protected $primaryKey = 'id_layanan';

    /**
     * Primary key bukan integer.
     */
    protected $keyType = 'string';

    /**
     * Nonaktifkan auto-increment karena ID berupa string.
     */
    public $incrementing = false;

    /**
     * Kolom yang bisa diisi massal.
     */
    protected $fillable = [
        'id_layanan',
        'nama_layanan',
        'harga',
    ];

    /**
     * Relasi: Layanan memiliki banyak Transaksi.
     */
    public function transaksis(): HasMany
    {
        return $this->hasMany(Transaksi::class, 'id_layanan', 'id_layanan');
    }

    /**
     * Generate ID layanan otomatis dengan format L001, L002, dst.
     */
    public static function generateId(): string
    {
        $last = self::orderByDesc('id_layanan')->first();

        if (!$last) {
            return 'L001';
        }

        // Ambil angka dari ID terakhir (misal L001 → 1)
        $number = (int) substr($last->id_layanan, 1);
        return 'L' . str_pad($number + 1, 3, '0', STR_PAD_LEFT);
    }
}
