<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarTopik;
use App\Models\Kelompok;
use App\Models\Mahasiswa;
use App\Notifications\PenolakanKelompokNotification;

class KelompokController extends Controller
{
    public function terima(Request $request)
    {
        // Update status topik menjadi 'Proposal'
        $judul = $request->judul;
        $topik = DaftarTopik::where('judul', $judul)->first();
        if ($topik) {
            $topik->status = 'Proposal';
            $topik->save();
            return back()->with('success', 'Kelompok sudah fix dengan topik ini!');
        }
        return back()->with('error', 'Topik tidak ditemukan!');
    }

    public function tolak(Request $request)
    {
        $judul = $request->judul;
        $alasan = $request->alasan;
        // Ambil semua anggota kelompok sebelum dihapus
        $anggota = Kelompok::where('judul', $judul)->get();
        foreach ($anggota as $item) {
            $mahasiswa = Mahasiswa::where('nim', $item->nim)->first();
            if ($mahasiswa) {
                $mahasiswa->notify(new PenolakanKelompokNotification($judul, $alasan));
            }
        }
        // Hapus semua anggota kelompok pada topik ini
        Kelompok::where('judul', $judul)->delete();
        // Hapus data topik di daftar_topik
        DaftarTopik::where('judul', $judul)->delete();
        // Simpan alasan penolakan (sementara: flash session)
        return back()->with('success', 'Kelompok dan topik dihapus. Alasan: ' . $alasan);
    }
} 