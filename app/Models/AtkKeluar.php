<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ATK;

class AtkKeluar extends Model
{
    use HasFactory;

    protected $table = 'atk_keluar';

    protected $fillable = [
        'atk_id',          // foreign key ke tabel atk
        'jumlah_keluar_alat',
        'tanggal_keluar_alat',
        'keterangan_alat',
        'foto',
    ];

    
    protected $casts = [
        'foto' => 'array',
    ];

    /**
     * Relasi ke model ATK (barang yang keluar berasal dari ATK)
     */
    public function atk()
    {
        return $this->belongsTo(ATK::class, 'atk_id');
    }
}
