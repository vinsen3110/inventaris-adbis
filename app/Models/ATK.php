<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ATK extends Model
{
    use HasFactory;

    protected $table = 'atk';

    protected $fillable = [
        'nama_barang',
        'jumlah',
        'satuan',
        'tanggal_masuk',
        'keterangan',
        'foto_1',
        'foto_2',
        'foto_3',
    ];
}
