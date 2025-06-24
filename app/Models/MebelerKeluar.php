<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Mebeler;
class MebelerKeluar extends Model
{
    use HasFactory;

    protected $table = 'mebeler_keluars'; // atau 'alat_keluar' sesuai migration kamu

    protected $fillable = [
        'mebeler_id',
        'jumlah_keluar',
        'tanggal_keluar',
        'keterangan',
        'foto',
    ];

    protected $casts = [
        'foto' => 'array',
    ];

    public function mebeler()
    {
        return $this->belongsTo(Mebeler::class, 'mebeler_id');
    }
}
