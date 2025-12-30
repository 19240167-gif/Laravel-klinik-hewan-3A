<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemilikHewan extends Model
{
    use HasFactory;

    protected $table = 'pemilik_hewan';
    protected $primaryKey = 'id_pemilik_hewan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_pemilik_hewan',
        'user_id',
        'nama_pemilik',
        'no_tlp',
        'alamat',
        'jenis_pendaftaran'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Hewan (one to many)
    public function hewan()
    {
        return $this->hasMany(Hewan::class, 'id_pemilik_hewan', 'id_pemilik_hewan');
    }

    // Relasi ke Pendaftaran (one to many)
    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'id_pemilik_hewan', 'id_pemilik_hewan');
    }
}
