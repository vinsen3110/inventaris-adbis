<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Atk;
use App\Models\Alat;
use App\Models\Mebeler;

class LaporanInventarisController extends Controller
{
    public function downloadPDF()
    {
        $data = Atk::all();
        $alats = Alat::all();
        $mebelers = Mebeler::all();
        $pdf = Pdf::loadView('laporan.masuk_pdf', compact('data', 'alats', 'mebelers'))

            ->setPaper('A4', 'landscape');

        return $pdf->download('laporan_inventaris.pdf');
    }
}
