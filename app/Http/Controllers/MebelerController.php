<?php

namespace App\Http\Controllers;

use App\Models\Mebeler;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class MebelerController extends Controller
{
    public function storeMebeler(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_mebeler'            => 'required|string',
            'jumlah_mebeler'          => 'required|integer',
            'satuan_mebeler'          => 'required|string',
            'tanggal_masuk_mebeler'  => 'required|date',
            'foto.*'                  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'keterangan_mebeler'      => 'nullable|string',
        ]);

        $fotoPathArray = [];

        // Cek dan simpan foto jika ada
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $path = $file->store('foto-mebeler', 'public');
                $fotoPathArray[] = $path;
            }
        }

        // Simpan data ke database
        Mebeler::create([
            'nama_mebeler'           => $request->nama_mebeler,
            'jumlah_mebeler'         => $request->jumlah_mebeler,
            'satuan_mebeler'         => $request->satuan_mebeler,
            'tanggal_masuk_mebeler' => $request->tanggal_masuk_mebeler,
            'foto'                   => json_encode($fotoPathArray),
            'keterangan_mebeler'     => $request->keterangan_mebeler,
        ]);

        return redirect()->back()->with('success', 'Data mebeler berhasil ditambahkan.');
    }

    public function updateMebeler(Request $request, $id)
    {
        $request->validate([
            'nama_mebeler' => 'required|string',
            'jumlah_mebeler' => 'required|integer',
            'satuan_mebeler' => 'required|string',
            'tanggal_masuk_mebeler' => 'required|date',
            'foto.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'keterangan_mebeler' => 'nullable|string',
        ]);

        $mebeler = Mebeler::findOrFail($id);

        // Ambil foto lama
        $existingFotos = json_decode($mebeler->foto, true) ?? [];

        // Hapus foto yang dipilih untuk dihapus
        if ($request->has('hapus_foto')) {
            foreach ($request->hapus_foto as $hapus) {
                if (($key = array_search($hapus, $existingFotos)) !== false) {
                    // Hapus dari storage
                    Storage::disk('public')->delete($hapus);
                    // Hapus dari array
                    unset($existingFotos[$key]);
                }
            }
        }

        // Upload foto baru
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $existingFotos[] = $file->store('foto-mebeler', 'public');
            }
        }

        // Simpan perubahan
        $mebeler->update([
            'nama_mebeler' => $request->nama_mebeler,
            'jumlah_mebeler' => $request->jumlah_mebeler,
            'satuan_mebeler' => $request->satuan_mebeler,
            'tanggal_masuk_mebeler' => $request->tanggal_masuk_mebeler,
            'foto' => json_encode(array_values($existingFotos)), // urutkan ulang indexnya
            'keterangan_mebeler' => $request->keterangan_mebeler,
        ]);

        return redirect()->back()->with('success', 'Data mebeler berhasil diperbarui.');
    }

    public function destroyMebeler($id)
{
    $mebeler = Mebeler::findOrFail($id);

    // Hapus semua foto dari storage jika ada
    if ($mebeler->foto) {
        $fotos = json_decode($mebeler->foto, true);
        foreach ($fotos as $foto) {
            Storage::disk('public')->delete($foto);
        }
    }

    // Hapus data dari database
    $mebeler->delete();

    return redirect()->back()->with('success', 'Data mebeler berhasil dihapus.');
}
}
