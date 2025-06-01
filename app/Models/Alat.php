<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    // Nama tabel (opsional jika sudah sesuai konvensi plural)
    protected $table = 'alats';

    // Kolom yang boleh diisi mass assignment
    protected $fillable = [
        'nama_alat',
        'jumlah_alat',
        'satuan_alat',
        'tanggal_masuk_alat',
        'foto',
        'keterangan_alat',
    ];

    // Casting kolom 'foto' JSON menjadi array otomatis
    protected $casts = [
        'foto' => 'array',
    ];
}
