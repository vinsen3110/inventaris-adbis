<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Atk;
use App\Models\AtkKeluar;
use App\Models\Alat;
use App\Models\AlatKeluar;
use App\Models\Mebeler;
use App\Models\MebelerKeluar;
use Illuminate\Support\Facades\Storage;

class KeluarController extends Controller
{
    public function index()
    {
        $atkKeluars = AtkKeluar::with('atk')->get(); // menampilkan relasi dengan atk
        $dataAtk = ATK::all(); // untuk dropdown pilihan ATK
        $alatKeluar = AlatKeluar::with('alat')->get();
        $dataAlat = Alat::all();
        $mebelerKeluar = MebelerKeluar::with('mebeler')->get();
        $dataMebeler = Mebeler::all();
        return view('barang-keluar', compact('atkKeluars', 'dataAtk', 'alatKeluar', 'dataAlat', 'mebelerKeluar', 'dataMebeler'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'atk_id'             => 'required|exists:atk,id',
            'jumlah_keluar_alat'      => 'required|integer|min:1',
            'tanggal_keluar_alat'     => 'required|date',
            'keterangan_alat'         => 'nullable|string',
            'foto.*'             => 'nullable|image|max:2048',
        ]);

        $fotoPaths = [];

        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $fotoPaths[] = $file->store('foto-keluar', 'public');
            }
        }

        AtkKeluar::create([
            'atk_id'         => $request->atk_id,
            'jumlah_keluar_alat'  => $request->jumlah_keluar_alat,
            'tanggal_keluar_alat' => $request->tanggal_keluar_alat,
            'keterangan_alat'     => $request->keterangan_alat,
            'foto'           => json_encode($fotoPaths),
        ]);

        return redirect()->back()->with('success', 'Barang keluar berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'atk_id'         => 'required|exists:atk,id',
            'jumlah_keluar_alat'  => 'required|integer|min:1',
            'tanggal_keluar_alat' => 'required|date',
            'keterangan_alat'     => 'nullable|string',
            'foto.*'         => 'nullable|image|max:2048',
            'hapus_foto'     => 'nullable|array',
        ]);

        $keluar = AtkKeluar::findOrFail($id);

        $fotoLama = json_decode($keluar->foto, true) ?? [];
        $fotoBaru = [];

        // Hapus foto lama jika dicentang
        $fotoDihapus = $request->input('hapus_foto', []);
        foreach ($fotoLama as $foto) {
            if (in_array($foto, $fotoDihapus)) {
                Storage::disk('public')->delete($foto);
            } else {
                $fotoBaru[] = $foto;
            }
        }

        // Tambah foto baru jika ada
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $fotoBaru[] = $file->store('foto-keluar', 'public');
            }
        }

        $keluar->update([
            'atk_id'         => $request->atk_id,
            'jumlah_keluar_alat'  => $request->jumlah_keluar_alat,
            'tanggal_keluar_alat' => $request->tanggal_keluar_alat,
            'keterangan_alat'     => $request->keterangan_alat,
            'foto'           => json_encode($fotoBaru),
        ]);

        return redirect()->back()->with('success', 'Data barang keluar berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $keluar = AtkKeluar::findOrFail($id);

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
