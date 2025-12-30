<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    use HasFactory;

    protected $table = 'pemeriksaan';
    protected $primaryKey = 'id_pemeriksaan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_pemeriksaan',
        'id_pendaftaran',
        'id_dokter_hewan',
        'diagnosa',
        'tindakan',
        'tanggal_periksa'
    ];

    protected $casts = [
        'tanggal_periksa' => 'date'
    ];

    // Relasi ke Pendaftaran (many to one)
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'id_pendaftaran', 'id_pendaftaran');
    }

    // Relasi ke DokterHewan (many to one)
    public function dokterHewan()
    {
        return $this->belongsTo(DokterHewan::class, 'id_dokter_hewan', 'id_dokter_hewan');
    }

    // Relasi ke Pembayaran (one to one)
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_pemeriksaan', 'id_pemeriksaan');
    }
}
