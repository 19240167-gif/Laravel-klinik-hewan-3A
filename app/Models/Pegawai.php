<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $primaryKey = 'id_pegawai';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_pegawai',
        'nama_pegawai',
        'jenis_kelamin',
        'no_telepon_pegawai'
    ];

    // Relasi ke Pendaftaran (one to many)
    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'id_pegawai', 'id_pegawai');
    }
}
