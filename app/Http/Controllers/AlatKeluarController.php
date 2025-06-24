<?php

namespace App\Http\Controllers;

use App\Models\AlatKeluar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AlatKeluarController extends Controller
{
    public function storeAlat(Request $request)
    {
        $request->validate([
            'alat_id'         => 'required|exists:alats,id',
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

        AlatKeluar::create([
            'alat_id'        => $request->alat_id,
            'jumlah_keluar'  => $request->jumlah_keluar,
            'tanggal_keluar' => $request->tanggal_keluar,
            'keterangan'     => $request->keterangan,
            'foto'           => json_encode($fotoPaths),
        ]);

        return redirect()->back()->with('success', 'Data alat keluar berhasil disimpan.');
    }
    public function updateAlat(Request $request, $id)
    {
        $request->validate([
            'alat_id'         => 'required|exists:alats,id',
            'jumlah_keluar'   => 'required|integer|min:1',
            'tanggal_keluar'  => 'required|date',
            'keterangan'      => 'nullable|string',
            'foto.*'          => 'nullable|image|max:2048',
        ]);

        $alatKeluar = AlatKeluar::findOrFail($id);

        $data = [
            'alat_id'        => $request->alat_id,
            'jumlah_keluar'  => $request->jumlah_keluar,
            'tanggal_keluar' => $request->tanggal_keluar,
            'keterangan'     => $request->keterangan,
        ];

        // Handle upload foto baru
        if ($request->hasFile('foto')) {
            $fotoPaths = [];
            foreach ($request->file('foto') as $file) {
                $fotoPaths[] = $file->store('foto-barang', 'public');
            }
            $data['foto'] = json_encode($fotoPaths);
        }

        $alatKeluar->update($data);

        return redirect()->back()->with('success', 'Data alat keluar berhasil diperbarui.');
    }

    public function destroyAlat($id)
    {
        $keluar = AlatKeluar::findOrFail($id);

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
