<?php

namespace App\Http\Controllers;

use App\Models\AlatOlahraga;
use Illuminate\Http\Request;

class AlatOlahragaController extends Controller
{
    public function index()
    {
        $alat = AlatOlahraga::all();

        $totalJenis = AlatOlahraga::distinct()
            ->count('jenis_alat');

        $totalBaik = AlatOlahraga::where('kondisi', 'Baik')
            ->count();

        $totalPerbaikan = AlatOlahraga::where(
            'kondisi',
            'Perlu Perbaikan'
        )->count();

        return view('alat.index', compact(
            'alat',
            'totalJenis',
            'totalBaik',
            'totalPerbaikan'
        ));
    }

    public function create()
    {
        return view('alat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_alat' => 'required|unique:alat_olahraga,kode_alat',
            'nama_alat' => 'required',
            'jenis_alat' => 'required',
            'kondisi' => 'required',
            'tarif_sewa' => 'required|numeric|min:0',
        ]);

        AlatOlahraga::create($request->only([
            'kode_alat',
            'nama_alat',
            'jenis_alat',
            'kondisi',
            'tarif_sewa',
        ]));

        return redirect('/')
            ->with('success', 'Alat olahraga berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $alat = AlatOlahraga::findOrFail($id);

        return view('alat.edit', compact('alat'));
    }

    public function update(Request $request, $id)
    {
        $alat = AlatOlahraga::findOrFail($id);

        $request->validate([
            'kode_alat' => 'required|unique:alat_olahraga,kode_alat,' . $id,
            'nama_alat' => 'required',
            'jenis_alat' => 'required',
            'kondisi' => 'required',
            'tarif_sewa' => 'required|numeric|min:0',
        ]);

        $alat->update($request->only([
            'kode_alat',
            'nama_alat',
            'jenis_alat',
            'kondisi',
            'tarif_sewa',
        ]));

        return redirect('/')
            ->with('success', 'Data alat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $alat = AlatOlahraga::findOrFail($id);
        $alat->delete();
        return redirect('/')
            ->with('success', 'Data alat berhasil dihapus!');
    }
}
