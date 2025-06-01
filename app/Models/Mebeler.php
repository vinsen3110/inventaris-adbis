<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mebeler extends Model
{

     protected $table = 'mebelers';
    protected $fillable = [
        'nama_mebeler',
        'jumlah_mebeler',
        'satuan_mebeler',
        'tanggal_masuk_mebeler',
        'foto',
        'keterangan_mebeler',
    ];

    protected $casts = [
        'foto' => 'array',
    ];
}
