<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;

    protected $table = 'alats'; // optional, tapi bisa ditulis biar eksplisit

    protected $fillable = [
        'nama_alat',
        'jumlah_alat',
        'satuan_alat',
        'tanggal_masuk_alat',
        'foto',
        'keterangan_alat',
    ];

    protected $casts = [
        'foto' => 'array',
    ];

    // Relasi ke alat_keluars
    public function keluars()
    {
        return $this->hasMany(AlatKeluar::class, 'alat_id');
    }
}
