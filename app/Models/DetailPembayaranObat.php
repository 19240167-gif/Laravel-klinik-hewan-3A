<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembayaranObat extends Model
{
    use HasFactory;

    protected $table = 'detail_pembayaran_obat';
    public $incrementing = false;
    protected $primaryKey = null;

    protected $fillable = [
        'id_pembayaran',
        'id_obat',
        'jumlah',
        'subtotal'
    ];

    // Relasi ke Pembayaran (many to one)
    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'id_pembayaran', 'id_pembayaran');
    }

    // Relasi ke Obat (many to one)
    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat', 'id_obat');
    }
}
