<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Atk;
use App\Models\Mebeler;

class MasukController extends Controller
{
   public function index() {
    $data = Atk::all();
    $mebelers = Mebeler::all(); // Ambil data mebeler
    return view('barang-masuk', compact('data','mebelers'));
}
  public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string',
            'jumlah' => 'required|integer',
            'satuan' => 'required|string',
            'tanggal_masuk' => 'required|date',
            'foto_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        $data = $request->all();

        foreach (['foto_1', 'foto_2', 'foto_3'] as $foto) {
            if ($request->hasFile($foto)) {
                $extension = $request->file($foto)->getClientOriginalExtension();
                $filename = $request->nama_barang . '-' . $foto . '-' . now()->timestamp . '.' . $extension;
               $request->file($foto)->storeAs('foto-atk', $filename);
                $data[$foto] = $filename;
            }
        }

        Atk::create($data);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $atk = Atk::findOrFail($id);

        $request->validate([
            'nama_barang' => 'required|string',
            'jumlah' => 'required|integer',
            'satuan' => 'required|string',
            'tanggal_masuk' => 'required|date',
            'foto_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        $data = $request->all();

        foreach (['foto_1', 'foto_2', 'foto_3'] as $foto) {
            if ($request->hasFile($foto)) {
                $extension = $request->file($foto)->getClientOriginalExtension();
                $filename = $atk->nama_barang . '-' . $foto . '-' . now()->timestamp . '.' . $extension;
                $request->file($foto)->storeAs('               foto-atk', $filename);
                $data[$foto] = $filename;
            } else {
                // Kalau tidak upload file baru, biarkan foto lama tetap dipakai
                unset($data[$foto]);
            }
        }

        $atk->update($data);

        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $atk = Atk::findOrFail($id);
        // Optional: hapus file foto dari storage jika perlu
        $atk->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

     // Mebeler
    public function storeMebeler(Request $request) {

    Mebeler::create($request->all());
    return redirect()->back()->with('success', 'Data Mebeler berhasil ditambahkan');
    }

    public function updateMebeler(Request $request, $id) {
        $mebeler = Mebeler::findOrFail($id);
        $mebeler->update($request->all());
        return redirect()->back()->with('success', 'Data Mebeler berhasil diupdate');
    }

    public function destroyMebeler($id) {
        $mebeler = Mebeler::findOrFail($id);
        $mebeler->delete();
        return redirect()->back()->with('success', 'Data Mebeler berhasil dihapus');
    }
}
