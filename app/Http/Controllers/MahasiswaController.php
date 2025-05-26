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
    public function dataMahasiswa() {
        $user = auth()->guard('mahasiswa')->user();
        if ($user && $user->wajib_ganti_password) {
            return redirect('/mahasiswa/ganti-password-awal');
        }
        $nim = $user->nim;
        $prodi = $user->program_studi;

        // Data kelompok milik mahasiswa login
        $kelompokSaya = \App\Models\Kelompok::where('nim', $nim)->first();

        // Daftar dosen untuk pembimbing 2
        $dosenList = \App\Models\Dosen::all(['nama', 'kode_dosen']);

        // (Opsional) Data mahasiswa satu prodi, jika masih dibutuhkan
        $dataMahasiswa = Mahasiswa::where('program_studi', $prodi)->get();

        return view('mahasiswa.pembimbing-dua', compact('dataMahasiswa', 'kelompokSaya', 'dosenList'));
    }

    public function TemplateLaporan() {
        $user = auth()->guard('mahasiswa')->user();
        if ($user && $user->wajib_ganti_password) {
            return redirect('/mahasiswa/ganti-password-awal');
        }
        $templates = Template::all();
        return view('mahasiswa.template_laporan', compact('templates'));
    }

    public function pilihPembimbingDua(Request $request)
    {
        $user = auth()->guard('mahasiswa')->user();
        if ($user && $user->wajib_ganti_password) {
            return redirect('/mahasiswa/ganti-password-awal');
        }
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
        $user = auth()->guard('mahasiswa')->user();
        if ($user && $user->wajib_ganti_password) {
            return redirect('/mahasiswa/ganti-password-awal');
        }
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
        $user = auth()->guard('mahasiswa')->user();
        if ($user && $user->wajib_ganti_password) {
            return redirect('/mahasiswa/ganti-password-awal');
        }
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
        $user = auth()->guard('mahasiswa')->user();
        if ($user && $user->wajib_ganti_password) {
            return redirect('/mahasiswa/ganti-password-awal');
        }
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
        $user = auth()->guard('mahasiswa')->user();
        if ($user && $user->wajib_ganti_password) {
            return redirect('/mahasiswa/ganti-password-awal');
        }
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

    /**
     * Import Mahasiswa dari CSV (NIM, Nama Mahasiswa)
     */
    public function importCsv(Request $request)
    {
        $user = auth()->guard('mahasiswa')->user();
        if ($user && $user->wajib_ganti_password) {
            return redirect('/mahasiswa/ganti-password-awal');
        }
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);
        $file = $request->file('csv_file');
        $handle = fopen($file->getRealPath(), 'r');
        $header = fgetcsv($handle);
        // Cek jika header bukan NIM/Nama, asumsikan data langsung
        if ($header && (stripos($header[0], 'nim') !== false || stripos($header[1], 'nama') !== false)) {
            // header valid, lanjut
        } else {
            // header bukan header, treat as data
            rewind($handle);
        }
        $count = 0;
        while (($row = fgetcsv($handle)) !== false) {
            $nim = trim($row[0] ?? '');
            $nama = trim($row[1] ?? '');
            if ($nim && $nama) {
                // Cek jika sudah ada, skip
                if (!\App\Models\Mahasiswa::where('nim', $nim)->exists()) {
                    \App\Models\Mahasiswa::create([
                        'nim' => $nim,
                        'nama' => $nama,
                        'kelas' => '-',
                        'program_studi' => '-',
                        'fakultas' => '-',
                        'angkatan' => date('Y'),
                        'email' => $nim . '@dummy.local',
                        'no_hp' => null,
                        'nama_pengguna' => $nim,
                        'kata_sandi' => bcrypt($nim), // password default = nim
                        'foto' => null,
                        'role' => 'mahasiswa',
                        'wajib_ganti_password' => 1, // Selalu 1
                    ]);
                    $count++;
                }
            }
        }
        fclose($handle);
        return redirect('/admin/mahasiswa')->with('success', "Berhasil import $count mahasiswa dari CSV (wajib ganti password).");
    }

    /**
     * Import Mahasiswa dari CSV (NIM, Nama Mahasiswa) dengan wajib_ganti_password otomatis 1
     */
    public function importCsvWajibGanti(Request $request)
    {
        $user = auth()->guard('mahasiswa')->user();
        if ($user && $user->wajib_ganti_password) {
            return redirect('/mahasiswa/ganti-password-awal');
        }
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);
        $file = $request->file('csv_file');
        $handle = fopen($file->getRealPath(), 'r');
        $header = fgetcsv($handle);
        // Cek jika header bukan NIM/Nama, asumsikan data langsung
        if ($header && (stripos($header[0], 'nim') !== false || stripos($header[1], 'nama') !== false)) {
            // header valid, lanjut
        } else {
            // header bukan header, treat as data
            rewind($handle);
        }
        $count = 0;
        while (($row = fgetcsv($handle)) !== false) {
            $nim = trim($row[0] ?? '');
            $nama = trim($row[1] ?? '');
            if ($nim && $nama) {
                // Cek jika sudah ada, skip
                if (!\App\Models\Mahasiswa::where('nim', $nim)->exists()) {
                    \App\Models\Mahasiswa::create([
                        'nim' => $nim,
                        'nama' => $nama,
                        'kelas' => '-',
                        'program_studi' => '-',
                        'fakultas' => '-',
                        'angkatan' => date('Y'),
                        'email' => $nim . '@dummy.local',
                        'no_hp' => null,
                        'nama_pengguna' => $nim,
                        'kata_sandi' => bcrypt($nim), // password default = nim
                        'foto' => null,
                        'role' => 'mahasiswa',
                        'wajib_ganti_password' => 1, // PASTIKAN 1
                    ]);
                    $count++;
                }
            }
        }
        fclose($handle);
        return redirect('/admin/mahasiswa')->with('success', "Berhasil import $count mahasiswa dari CSV (wajib ganti password).");
    }

    /**
     * Form ganti password awal (wajib)
     */
    public function formGantiPasswordAwal() {
        return view('mahasiswa.ganti_password_awal');
    }

    /**
     * Proses ganti password awal
     */
    public function gantiPasswordAwal(Request $request) {
        $request->validate([
            'kata_sandi_baru' => 'required|min:8',
            'konfirmasi_kata_sandi' => 'required|same:kata_sandi_baru',
            // Tambahan validasi profil
            'fakultas' => 'required|string|max:255',
            'program_studi' => 'required|string|max:255',
            'angkatan' => 'required|string|max:10',
            'kelas' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'no_hp' => 'nullable|string|max:20',
        ], [
            'kata_sandi_baru.required' => 'Kata Sandi Baru Wajib Diisi!',
            'kata_sandi_baru.min' => 'Kata Sandi Baru Minimal 8 Karakter',
            'konfirmasi_kata_sandi.required' => 'Konfirmasi Kata Sandi Wajib Diisi!',
            'konfirmasi_kata_sandi.same' => 'Konfirmasi Kata Sandi Tidak Sama',
            'fakultas.required' => 'Fakultas wajib diisi!',
            'program_studi.required' => 'Program Studi wajib diisi!',
            'angkatan.required' => 'Angkatan wajib diisi!',
            'kelas.required' => 'Kelas wajib diisi!',
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
        ]);
        $mahasiswa = auth()->guard('mahasiswa')->user();
        // Cek apakah password baru sama dengan lama
        if (\Hash::check($request->kata_sandi_baru, $mahasiswa->kata_sandi)) {
            return back()->withErrors(['kata_sandi_baru' => 'Kata Sandi Baru Harus Berbeda Dengan Kata Sandi Saat Ini!']);
        }
        $mahasiswa->kata_sandi = bcrypt($request->kata_sandi_baru);
        $mahasiswa->wajib_ganti_password = false;
        // Update profil tambahan
        $mahasiswa->fakultas = $request->fakultas;
        $mahasiswa->program_studi = $request->program_studi;
        $mahasiswa->angkatan = $request->angkatan;
        $mahasiswa->kelas = $request->kelas;
        $mahasiswa->email = $request->email;
        $mahasiswa->no_hp = $request->no_hp;
        $mahasiswa->save();
        return redirect('/mahasiswa/beranda')->with('success', 'Kata sandi & profil berhasil diubah!');
    }
}
