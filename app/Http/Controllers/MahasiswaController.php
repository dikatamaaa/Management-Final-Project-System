<?php

namespace App\Http\Controllers;

use App\Models\Kelompok;
use App\Models\Mahasiswa;
use App\Models\Template;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class MahasiswaController extends Controller
{
    /**
     * Menampilkan Form Data Kelompok Yang Sudah Ada
     */
    public function dataMahasiswa() : View {
        $nim = auth()->guard('mahasiswa')->user()->nim;
        $prodi = auth()->guard('mahasiswa')->user()->program_studi;

        // Data kelompok milik mahasiswa login
        $kelompokSaya = \App\Models\Kelompok::where('nim', $nim)->first();

        // Daftar dosen untuk pembimbing 2
        $dosenList = \App\Models\Dosen::all(['nama', 'kode_dosen']);

        // (Opsional) Data mahasiswa satu prodi, jika masih dibutuhkan
        $dataMahasiswa = Mahasiswa::where('program_studi', $prodi)->get();

        return view('mahasiswa.kelompok', compact('dataMahasiswa', 'kelompokSaya', 'dosenList'));
    }

    public function TemplateLaporan()
    {
        $templates = Template::all();
        return view('mahasiswa.template_laporan', compact('templates'));
    }

    public function pilihPembimbingDua(Request $request)
    {
        $nim = auth()->guard('mahasiswa')->user()->nim;
        $kelompok = \App\Models\Kelompok::where('nim', $nim)->first();
        if ($kelompok) {
            $kelompok->pembimbing_dua = $request->pembimbing_dua;
            $kelompok->save();
            return back()->with('success', 'Pembimbing 2 berhasil dipilih!');
        }
        return back()->with('error', 'Anda belum memiliki kelompok!');
    }
}
