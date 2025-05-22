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

    public function tambahAnggotaKelompok(Request $request, $id)
    {
        $topik = \App\Models\DaftarTopik::findOrFail($id);
        $nim_login = auth()->guard('mahasiswa')->user()->nim;
        // Pastikan mahasiswa login sudah booking topik ini
        $is_booking = \App\Models\Kelompok::where('judul', $topik->judul)->where('nim', $nim_login)->exists();
        if (!$is_booking) {
            return back()->with('error', 'Anda tidak berhak menambah anggota pada topik ini!');
        }
        // Cek apakah mahasiswa yang akan ditambah sudah punya kelompok/topik
        $nim_tambah = $request->nim;
        $sudah_punya = \App\Models\Kelompok::where('nim', $nim_tambah)->exists();
        if ($sudah_punya) {
            return back()->with('error', 'Mahasiswa ini sudah memiliki kelompok/topik!');
        }
        // Cek kuota kelompok
        $jumlah_anggota = \App\Models\Kelompok::where('judul', $topik->judul)->count();
        if ($jumlah_anggota >= $topik->kuota) {
            return back()->with('error', 'Kuota kelompok sudah penuh!');
        }
        // Ambil data mahasiswa yang akan ditambah
        $mahasiswa = \App\Models\Mahasiswa::where('nim', $nim_tambah)->first();
        if (!$mahasiswa) {
            return back()->with('error', 'Mahasiswa tidak ditemukan!');
        }
        // Tambahkan ke kelompok
        \App\Models\Kelompok::create([
            'judul' => $topik->judul,
            'nim' => $mahasiswa->nim,
            'nama_anggota' => $mahasiswa->nama,
            'pembimbing_satu' => $topik->dosen,
        ]);
        // Jika setelah penambahan kuota penuh, update status topik
        $jumlah_anggota_baru = \App\Models\Kelompok::where('judul', $topik->judul)->count();
        if ($jumlah_anggota_baru >= $topik->kuota) {
            $topik->status = 'Penuh';
            $topik->save();
        }
        return back()->with('success', 'Anggota berhasil ditambahkan ke kelompok!');
    }
}
