<?php

namespace App\Http\Controllers;

use App\Models\Atk;
use App\Models\Alat;
use App\Models\Mebeler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MasukController extends Controller
{
    public function index()
    {
        $data = Atk::all();
        $alats = Alat::all();
        $mebelers = Mebeler::all(); 
        return view('barang-masuk', compact('data', 'mebelers', 'alats',));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang'     => 'required|string',
            'jumlah'          => 'required|integer',
            'satuan'          => 'required|string',
            'tanggal_masuk'   => 'required|date',
            'foto.*'          => 'nullable|image|max:2048',
            'keterangan'      => 'nullable|string',
        ], [
            'nama_barang.required'    => 'Nama barang wajib diisi.',
            'nama_barang.string'      => 'Nama barang harus berupa teks.',

            'jumlah.required'         => 'Jumlah wajib diisi.',
            'jumlah.integer'          => 'Jumlah harus berupa angka.',

            'satuan.required'         => 'Satuan wajib diisi.',
            'satuan.string'           => 'Satuan harus berupa teks.',

            'tanggal_masuk.required'  => 'Tanggal masuk wajib diisi.',
            'tanggal_masuk.date'      => 'Tanggal masuk harus berupa tanggal yang valid.',

            'foto.*.image'            => 'Setiap file harus berupa gambar.',
            'foto.*.mimes'            => 'Format foto harus jpeg, png, jpg, gif, atau svg.',
            'foto.*.max'              => 'Ukuran maksimal foto 2MB per file.',

            'keterangan.string'       => 'Keterangan harus berupa teks.',
        ]);

        $fotoPaths = [];

        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $fotoPaths[] = $file->store('foto-barang', 'public');
            }
        }

        ATK::create([
            'nama_barang'   => $request->nama_barang,
            'jumlah'        => $request->jumlah,
            'satuan'        => $request->satuan,
            'tanggal_masuk' => $request->tanggal_masuk,
            'foto'          => json_encode($fotoPaths),
            'keterangan'    => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang'     => 'required|string',
            'jumlah'          => 'required|integer',
            'satuan'          => 'required|string',
            'tanggal_masuk'   => 'required|date',
            'foto.*'          => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'keterangan'      => 'nullable|string',
        ]);

        $atk = ATK::findOrFail($id);

        $fotoLama = json_decode($atk->foto, true) ?? [];
        $fotoBaru = [];

        $fotoDihapus = $request->input('hapus_foto', []);

        foreach ($fotoLama as $foto) {
            if (in_array($foto, $fotoDihapus)) {
                Storage::disk('public')->delete($foto);
            } else {
                $fotoBaru[] = $foto;
            }
        }

        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $fotoBaru[] = $file->store('foto-barang', 'public');
            }
        }

        $atk->update([
            'nama_barang'   => $request->nama_barang,
            'jumlah'        => $request->jumlah,
            'satuan'        => $request->satuan,
            'tanggal_masuk' => $request->tanggal_masuk,
            'foto'          => json_encode($fotoBaru),
            'keterangan'    => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }




    public function destroy($id)
    {
        $atk = ATK::findOrFail($id);
        if ($atk->foto) {
            $fotoArray = json_decode($atk->foto, true);
            if (is_array($fotoArray)) {
                foreach ($fotoArray as $foto) {
                    Storage::disk('public')->delete($foto);
                }
            }
        }

        $atk->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    // Mebeler
    public function storeMebeler(Request $request)
    {

        Mebeler::create($request->all());
        return redirect()->back()->with('success', 'Data Mebeler berhasil ditambahkan');
    }

    public function updateMebeler(Request $request, $id)
    {
        $mebeler = Mebeler::findOrFail($id);
        $mebeler->update($request->all());
        return redirect()->back()->with('success', 'Data Mebeler berhasil diupdate');
    }

    public function destroyMebeler($id)
    {
        $mebeler = Mebeler::findOrFail($id);
        $mebeler->delete();
        return redirect()->back()->with('success', 'Data Mebeler berhasil dihapus');
    }
}
