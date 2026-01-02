<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokterHewan extends Model
{
    use HasFactory;

    protected $table = 'dokter_hewan';
    protected $primaryKey = 'id_dokter_hewan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_dokter_hewan',
        'nama_dokter',
        'no_sip',
        'biaya_periksa'
    ];

    // Relasi ke Pemeriksaan (one to many)
    public function pemeriksaan()
    {
        return $this->hasMany(Pemeriksaan::class, 'id_dokter_hewan', 'id_dokter_hewan');
    }

    // Relasi ke User (one to one)
    public function user()
    {
        return $this->belongsTo(User::class, 'nama_dokter', 'name');
    }
}
