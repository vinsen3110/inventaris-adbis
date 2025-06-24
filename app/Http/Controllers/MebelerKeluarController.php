<?php

namespace App\Http\Controllers;

use App\Models\MebelerKeluar;
use App\Models\Mebeler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MebelerKeluarController extends Controller
{
    public function storeMebeler(Request $request)
    {
        $request->validate([
            'mebeler_id'         => 'required|exists:mebelers,id',
            'jumlah_keluar'   => 'required|integer|min:1',
            'tanggal_keluar'  => 'required|date',
            'keterangan'      => 'nullable|string',
            'foto.*'          => 'nullable|image|max:2048', // maksimal 2MB per file
        ]);

        $fotoPaths = [];

        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $fotoPaths[] = $file->store('foto-barang', 'public');
            }
        }
        // dd($request->all());
        MebelerKeluar::create([
            'mebeler_id'      => $request->mebeler_id,
            'jumlah_keluar'  => $request->jumlah_keluar,
            'tanggal_keluar' => $request->tanggal_keluar,
            'keterangan'     => $request->keterangan,
            'foto'           => json_encode($fotoPaths),
        ]);

        return redirect()->back()->with('success', 'Data alat keluar berhasil disimpan.');
    }
    public function updateMebeler(Request $request, $id)
    {
        $request->validate([
            'mebeler_id'     => 'required|exists:mebelers,id',
            'jumlah_keluar'  => 'required|integer|min:1',
            'tanggal_keluar' => 'required|date',
            'keterangan'     => 'nullable|string',
            'foto.*'         => 'nullable|image|max:2048',
        ]);

        $mebelerKeluar = MebelerKeluar::findOrFail($id);

        $data = [
            'mebeler_id'     => $request->mebeler_id,
            'jumlah_keluar'  => $request->jumlah_keluar,
            'tanggal_keluar' => $request->tanggal_keluar,
            'keterangan'     => $request->keterangan,
        ];

        $existingFotos = json_decode($mebelerKeluar->foto, true) ?? [];

        if ($request->filled('hapus_foto')) {
            foreach ($request->hapus_foto as $hapus) {
                if (Storage::disk('public')->exists($hapus)) {
                    Storage::disk('public')->delete($hapus);
                }

                $existingFotos = array_filter($existingFotos, function ($foto) use ($hapus) {
                    return $foto !== $hapus;
                });
            }
        }

        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $existingFotos[] = $file->store('foto-barang', 'public');
            }
        }

        $data['foto'] = json_encode(array_values($existingFotos));

        $mebelerKeluar->update($data);

        return redirect()->back()->with('success', 'Data mebeler keluar berhasil diperbarui.');
    }


    public function destroyMebeler($id)
    {
        $keluar = mebelerKeluar::findOrFail($id);

        if ($keluar->foto) {
            $fotoArray = json_decode($keluar->foto, true);
            foreach ($fotoArray as $foto) {
                Storage::disk('public')->delete($foto);
            }
        }

        $keluar->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
