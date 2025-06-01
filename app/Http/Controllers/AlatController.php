<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AlatController extends Controller
{
    public function storeAlat(Request $request)
    {
        $request->validate([
            'nama_alat'          => 'required|string',
            'jumlah_alat'        => 'required|integer',
            'satuan_alat'        => 'required|string',
            'tanggal_masuk_alat' => 'required|date',
            'foto.*'             => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'keterangan_alat'    => 'nullable|string',
        ], [
            'foto.*.image'       => 'File harus berupa gambar.',
            'foto.*.mimes'       => 'Format gambar harus jpeg, png, jpg, gif, svg.',
            'foto.*.max'         => 'Ukuran gambar maksimal 2MB.',
        ]);

        $fotoPaths = [];
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $fotoPaths[] = $file->store('foto-alat', 'public');
            }
        }

        Alat::create([
            'nama_alat'          => $request->nama_alat,
            'jumlah_alat'        => $request->jumlah_alat,
            'satuan_alat'        => $request->satuan_alat,
            'tanggal_masuk_alat' => $request->tanggal_masuk_alat,
            'foto'               => json_encode($fotoPaths),
            'keterangan_alat'    => $request->keterangan_alat,
        ]);

        return redirect()->route('barang-masuk')->with('success', 'Data alat berhasil ditambahkan.');
    }

    public function updateAlat(Request $request, $id)
    {
        $request->validate([
            'nama_alat'          => 'required|string',
            'jumlah_alat'        => 'required|integer',
            'satuan_alat'        => 'required|string',
            'tanggal_masuk_alat' => 'required|date',
            'foto.*'             => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'hapus_foto'         => 'nullable|array',
            'keterangan_alat'    => 'nullable|string',
        ], [
            'nama_alat.required' => 'Nama alat wajib diisi.',
            'jumlah_alat.required' => 'Jumlah alat wajib diisi.',
            'satuan_alat.required' => 'Satuan alat wajib diisi.',
            'tanggal_masuk_alat.required' => 'Tanggal masuk alat wajib diisi.',
            'foto.*.image' => 'File harus berupa gambar.',
            'foto.*.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau svg.',
            'foto.*.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $alat = Alat::findOrFail($id);

        // Ambil array foto lama dari DB
        $fotoLama = json_decode($alat->foto, true) ?? [];

        // Hapus foto yang dipilih untuk dihapus
        if ($request->has('hapus_foto')) {
            foreach ($request->hapus_foto as $hapusFoto) {
                // Hapus file fisik jika ada
                if (in_array($hapusFoto, $fotoLama) && Storage::disk('public')->exists($hapusFoto)) {
                    Storage::disk('public')->delete($hapusFoto);
                }
                // Hapus dari array foto lama
                $fotoLama = array_filter($fotoLama, fn($f) => $f !== $hapusFoto);
            }
        }

        // Upload foto baru jika ada
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $path = $file->store('foto-alat', 'public');
                $fotoLama[] = $path;
            }
        }

        // Update data alat
        $alat->update([
            'nama_alat'          => $request->nama_alat,
            'jumlah_alat'        => $request->jumlah_alat,
            'satuan_alat'        => $request->satuan_alat,
            'tanggal_masuk_alat' => $request->tanggal_masuk_alat,
            'foto'               => json_encode(array_values($fotoLama)), // pastikan array rapi
            'keterangan_alat'    => $request->keterangan_alat,
        ]);

        return redirect()->back()->with('success', 'Data alat berhasil diperbarui.');
    }

    public function destroyAlat($id)
    {
        $alat = Alat::findOrFail($id);

        // Hapus file foto dari storage jika ada
        $fotoArray = json_decode($alat->foto, true);
        if ($fotoArray && is_array($fotoArray)) {
            foreach ($fotoArray as $foto) {
                if (Storage::disk('public')->exists($foto)) {
                    Storage::disk('public')->delete($foto);
                }
            }
        }
        // Hapus data alat dari database
        $alat->delete();

        return redirect()->back()->with('success', 'Data alat berhasil dihapus.');
    }
}
