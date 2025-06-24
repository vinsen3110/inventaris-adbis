<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Alat;
class AlatKeluar extends Model
{
    use HasFactory;

    protected $table = 'alat_keluars'; // atau 'alat_keluar' sesuai migration kamu

    protected $fillable = [
        'alat_id',
        'jumlah_keluar',
        'tanggal_keluar',
        'keterangan',
        'foto',
    ];

    protected $casts = [
        'foto' => 'array',
    ];

    public function alat()
    {
        return $this->belongsTo(Alat::class, 'alat_id');
    }
}
