<?php
namespace App\Http\Controllers;

use App\Models\RubrikPenilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RubrikPenilaianController extends Controller
{
    // Tampilkan semua aspek rubrik milik dosen
    public function index()
    {
        $dosen_id = Auth::guard('dosen')->id();
        $rubrik = RubrikPenilaian::where('dosen_id', $dosen_id)->orderBy('cd')->orderBy('urutan')->get()->groupBy('cd');
        return view('dosen.rubrik_penilaian.index', compact('rubrik'));
    }

    // Form tambah aspek
    public function create()
    {
        return view('dosen.rubrik_penilaian.create');
    }

    // Simpan aspek baru
    public function store(Request $request)
    {
        $request->validate([
            'cd' => 'required|integer|min:1',
            'aspek' => 'required|string',
            'indikator' => 'required|array',
            'tipe' => 'required|in:individu,kelompok',
        ]);
        RubrikPenilaian::create([
            'dosen_id' => Auth::guard('dosen')->id(),
            'cd' => $request->cd,
            'aspek' => $request->aspek,
            'indikator' => $request->indikator,
            'bobot' => $request->bobot,
            'urutan' => $request->urutan ?? 0,
            'tipe' => $request->tipe,
        ]);
        return redirect()->route('dosen.rubrik-penilaian.index')->with('success', 'Aspek rubrik berhasil ditambahkan!');
    }

    // Form edit aspek
    public function edit($id)
    {
        $aspek = RubrikPenilaian::findOrFail($id);
        return view('dosen.rubrik_penilaian.edit', compact('aspek'));
    }

    // Update aspek
    public function update(Request $request, $id)
    {
        $aspek = RubrikPenilaian::findOrFail($id);
        $request->validate([
            'cd' => 'required|integer|min:1',
            'aspek' => 'required|string',
            'indikator' => 'required|array',
            'tipe' => 'required|in:individu,kelompok',
        ]);
        $aspek->update([
            'cd' => $request->cd,
            'aspek' => $request->aspek,
            'indikator' => $request->indikator,
            'bobot' => $request->bobot,
            'urutan' => $request->urutan ?? 0,
            'tipe' => $request->tipe,
        ]);
        return redirect()->route('dosen.rubrik-penilaian.index')->with('success', 'Aspek rubrik berhasil diupdate!');
    }

    // Hapus aspek
    public function destroy($id)
    {
        $aspek = RubrikPenilaian::findOrFail($id);
        $aspek->delete();
        return redirect()->route('dosen.rubrik-penilaian.index')->with('success', 'Aspek rubrik berhasil dihapus!');
    }
} 