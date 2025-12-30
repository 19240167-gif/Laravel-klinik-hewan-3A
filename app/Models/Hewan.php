<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hewan extends Model
{
    use HasFactory;

    protected $table = 'hewan';
    protected $primaryKey = 'id_hewan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_hewan',
        'nama_hewan',
        'jenis_hewan',
        'jenis_kelamin',
        'umur',
        'id_pemilik_hewan'
    ];

    // Relasi ke PemilikHewan (many to one)
    public function pemilikHewan()
    {
        return $this->belongsTo(PemilikHewan::class, 'id_pemilik_hewan', 'id_pemilik_hewan');
    }
}
