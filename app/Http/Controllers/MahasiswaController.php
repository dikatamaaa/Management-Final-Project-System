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

        return view('mahasiswa.pembimbing-dua', compact('dataMahasiswa', 'kelompokSaya', 'dosenList'));
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
            // Update semua anggota kelompok dengan judul yang sama
            \App\Models\Kelompok::where('judul', $kelompok->judul)
                ->update([
                    'pembimbing_dua' => $request->pembimbing_dua,
                    'status_pembimbing_dua' => 'pending',
                    'alasan_tolak_pembimbing_dua' => null
                ]);
            return back()->with('success', 'Pembimbing 2 berhasil dipilih untuk seluruh anggota kelompok!');
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

    /**
     * Halaman dokumen & bimbingan mahasiswa
     */
    public function dokumenBimbinganPage() {
        $nim = auth()->guard('mahasiswa')->user()->nim;
        $dokumenList = \App\Models\DokumenMahasiswa::where('nim', $nim)->orderByDesc('created_at')->get();
        $bimbinganList = \App\Models\Bimbingan::where('nim', $nim)->orderByDesc('created_at')->get();
        $pembimbingSatu = \App\Models\Kelompok::where('nim', $nim)->first()->pembimbing_satu ?? null;
        $pembimbingDua = \App\Models\Kelompok::where('nim', $nim)->first()->pembimbing_dua ?? null;
        $statusPembimbingDua = \App\Models\Kelompok::where('nim', $nim)->first()->status_pembimbing_dua ?? null;
        return view('mahasiswa.dokumen_bimbingan', compact('dokumenList', 'bimbinganList', 'pembimbingSatu', 'pembimbingDua', 'statusPembimbingDua'));
    }

    /**
     * Simpan dokumen mahasiswa
     */
    public function storeDokumen(Request $request) {
        $request->validate([
            'judul' => 'required|string|max:255',
            'link' => [
                'required',
                'url',
                function ($attribute, $value, $fail) {
                    $allowed = [
                        'drive.google.com',
                        'onedrive.live.com',
                        'dropbox.com',
                        'sharepoint.com',
                        'telkomuniversityofficial-my.sharepoint.com'
                    ];
                    $found = false;
                    foreach ($allowed as $domain) {
                        if (strpos($value, $domain) !== false) {
                            $found = true;
                            break;
                        }
                    }
                    if (!$found) {
                        $fail('Link hanya boleh dari Google Drive, OneDrive, Dropbox, atau SharePoint!');
                    }
                }
            ],
        ]);
        \App\Models\DokumenMahasiswa::create([
            'nim' => auth()->guard('mahasiswa')->user()->nim,
            'judul' => $request->judul,
            'link' => $request->link,
            'status' => 'pending',
        ]);
        return back()->with('success', 'Dokumen berhasil dikumpulkan!');
    }

    /**
     * Simpan pengajuan bimbingan
     */
    public function storeBimbingan(Request $request) {
        $request->validate([
            'judul' => 'required|string|max:255',
            'pembimbing' => 'required|in:1,2',
            'jadwal' => 'required|date_format:Y-m-d H:i',
            'catatan' => 'nullable|string',
        ]);
        $nim = auth()->guard('mahasiswa')->user()->nim;
        $pembimbingDua = \App\Models\Kelompok::where('nim', $nim)->first()->pembimbing_dua ?? null;
        $statusPembimbingDua = \App\Models\Kelompok::where('nim', $nim)->first()->status_pembimbing_dua ?? null;
        if ($request->pembimbing == '2' && (!$pembimbingDua || $statusPembimbingDua !== 'accepted')) {
            return back()->with('error', 'Anda belum memiliki pembimbing dua yang sudah diterima!');
        }
        \App\Models\Bimbingan::create([
            'nim' => $nim,
            'judul' => $request->judul,
            'pembimbing' => $request->pembimbing,
            'jadwal' => $request->jadwal,
            'status' => 'pending',
            'catatan' => $request->catatan,
        ]);
        return back()->with('success', 'Pengajuan bimbingan berhasil dikirim!');
    }
}
