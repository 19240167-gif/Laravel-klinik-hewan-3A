<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';
    protected $primaryKey = 'id_pendaftaran';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_pendaftaran',
        'id_pemilik_hewan',
        'id_hewan',
        'id_pegawai',
        'tanggal_daftar',
        'status',
        'keluhan'
    ];

    protected $casts = [
        'tanggal_daftar' => 'date'
    ];

    // Relasi ke PemilikHewan (many to one)
    public function pemilikHewan()
    {
        return $this->belongsTo(PemilikHewan::class, 'id_pemilik_hewan', 'id_pemilik_hewan');
    }

    // Relasi ke Hewan (many to one)
    public function hewan()
    {
        return $this->belongsTo(Hewan::class, 'id_hewan', 'id_hewan');
    }

    // Relasi ke Pegawai (many to one)
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }

    // Relasi ke Pemeriksaan (one to one)
    public function pemeriksaan()
    {
        return $this->hasOne(Pemeriksaan::class, 'id_pendaftaran', 'id_pendaftaran');
    }
}
