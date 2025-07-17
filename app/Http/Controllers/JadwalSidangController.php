<?php

namespace App\Http\Controllers;

use App\Models\JadwalSidang;
use App\Models\Kelompok;
use App\Models\Dosen;
use App\Models\Template;
use Illuminate\Http\Request;

class JadwalSidangController extends Controller
{
    public function index()
    {
        $jadwalSidang = JadwalSidang::with(['kelompok', 'dosenPenguji1', 'dosenPenguji2'])->get();
        // Ambil hanya kelompok yang status topiknya 'Sidang'
        $kelompokList = \App\Models\Kelompok::whereIn('judul', \App\Models\DaftarTopik::where('status', 'Sidang')->pluck('judul'))
            ->groupBy('judul')
            ->selectRaw('MIN(id) as id, judul')
            ->get();
        $dosenList = Dosen::all();
        $menampilkanDataTemplateDokumen = Template::all();
        
        return view('admin.penjadwalan_sidang', compact('jadwalSidang', 'kelompokList', 'dosenList', 'menampilkanDataTemplateDokumen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelompok_id' => 'required|exists:kelompok,id',
            'judul' => 'required|string',
            'tanggal_sidang' => 'required|date',
            'ruangan' => 'required|string',
            'penguji_1' => 'required|exists:dosen,id',
            'penguji_2' => 'required|exists:dosen,id|different:penguji_1',
            'jenis_sidang' => 'required|in:Sidang Akhir',
            'catatan' => 'nullable|string'
        ]);

        JadwalSidang::create($request->all());

        return redirect()->back()->with('success', 'Jadwal sidang berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kelompok_id' => 'required|exists:kelompok,id',
            'judul' => 'required|string',
            'tanggal_sidang' => 'required|date',
            'ruangan' => 'required|string',
            'penguji_1' => 'required|exists:dosen,id',
            'penguji_2' => 'required|exists:dosen,id|different:penguji_1',
            'jenis_sidang' => 'required|in:Sidang Akhir',
            'status' => 'required|in:Scheduled,Completed,Postponed,Selesai',
            'catatan' => 'nullable|string'
        ]);

        $jadwal = JadwalSidang::findOrFail($id);
        $jadwal->update($request->all());

        return redirect()->back()->with('success', 'Jadwal sidang berhasil diperbarui');
    }

    public function destroy($id)
    {
        $jadwal = JadwalSidang::findOrFail($id);
        $jadwal->delete();

        return redirect()->back()->with('success', 'Jadwal sidang berhasil dihapus');
    }
} 