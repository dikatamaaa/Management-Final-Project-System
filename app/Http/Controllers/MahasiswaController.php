<?php

namespace App\Http\Controllers;

use App\Models\Kelompok;
use App\Models\Mahasiswa;
use App\Models\Template;
use App\Models\PengaturanTopik;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

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

        // Ambil nama pembimbing satu dari tabel DaftarTopik (berdasarkan judul kelompok)
        $pembimbingSatu = null;
        if ($kelompokSaya) {
            $topik = \App\Models\DaftarTopik::where('judul', $kelompokSaya->judul)->first();
            $pembimbingSatu = $topik ? $topik->dosen : null;
        }

        return view('mahasiswa.pembimbing-dua', compact('dataMahasiswa', 'kelompokSaya', 'dosenList', 'pembimbingSatu'));
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
            'dokumen_terkait' => 'nullable|exists:dokumen_mahasiswa,id',
        ]);
        $nim = auth()->guard('mahasiswa')->user()->nim;
        $pembimbingDua = \App\Models\Kelompok::where('nim', $nim)->first()->pembimbing_dua ?? null;
        $statusPembimbingDua = \App\Models\Kelompok::where('nim', $nim)->first()->status_pembimbing_dua ?? null;
        if ($request->pembimbing == '2' && (!$pembimbingDua || $statusPembimbingDua !== 'accepted')) {
            return back()->with('error', 'Anda belum memiliki pembimbing dua yang sudah diterima!');
        }
        \App\Models\Bimbingan::create([
            'nim' => $nim,
            'judul_topik' => $request->judul,
            'judul' => $request->judul,
            'pembimbing' => $request->pembimbing,
            'jadwal' => $request->jadwal,
            'status' => 'pending',
            'catatan' => $request->catatan,
            'dokumen_terkait' => $request->dokumen_terkait,
        ]);
        return back()->with('success', 'Pengajuan bimbingan berhasil dikirim!');
    }

    /**
     * Import Mahasiswa dari CSV (NIM, Nama Mahasiswa)
     */
    public function importCsv(Request $request)
    {
        set_time_limit(300); // Tambah waktu eksekusi jadi 5 menit
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
        $batch = [];
        $now = now();
        $nims = [];
        while (($row = fgetcsv($handle)) !== false) {
            $nim = trim($row[0] ?? '');
            $nama = trim($row[1] ?? '');
            if ($nim && $nama) {
                $nims[] = $nim;
                $batch[] = [
                    'nim' => $nim,
                    'nama' => $nama,
                    'kelas' => '-',
                    'program_studi' => '-',
                    'fakultas' => '-',
                    'angkatan' => date('Y'),
                    'email' => $nim . '@dummy.local',
                    'no_hp' => null,
                    'nama_pengguna' => $nim,
                    'kata_sandi' => bcrypt($nim),
                    'foto' => null,
                    'role' => 'mahasiswa',
                    'wajib_ganti_password' => 1,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }
        fclose($handle);
        // Ambil NIM yang sudah ada agar tidak insert duplikat
        $existingNims = \App\Models\Mahasiswa::whereIn('nim', $nims)->pluck('nim')->toArray();
        $insertBatch = array_filter($batch, function($item) use ($existingNims) {
            return !in_array($item['nim'], $existingNims);
        });
        // Batch insert (per 500)
        $chunks = array_chunk($insertBatch, 500);
        $count = 0;
        foreach ($chunks as $chunk) {
            \App\Models\Mahasiswa::insert($chunk);
            $count += count($chunk);
        }
        return redirect('/admin/mahasiswa')->with('success', "Berhasil import $count mahasiswa dari CSV (wajib ganti password)." );
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
        if (Hash::check($request->kata_sandi_baru, $mahasiswa->kata_sandi)) {
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

    // Form Mahasiswa Membuat Topik Sendiri
    public function formBuatTopik() {
        $user = auth()->guard('mahasiswa')->user();
        if ($user && $user->wajib_ganti_password) {
            return redirect('/mahasiswa/ganti-password-awal');
        }
        // Cek apakah mahasiswa sudah punya topik/kelompok
        $sudah_punya = \App\Models\Kelompok::where('nim', $user->nim)->exists();
        if ($sudah_punya) {
            return redirect('/mahasiswa/daftar_topik')->with('error', 'Anda sudah memiliki topik/kelompok, tidak bisa membuat topik baru.');
        }
        $fakultas = $user->fakultas;
        $program_studi = $user->program_studi;
        // Ambil pengaturan admin dengan Eloquent Model
        $pengaturan = \App\Models\PengaturanTopik::first(); // pastikan pakai model, bukan query builder
        $bidangList = $pengaturan->list_bidang ?? [];
        $kuotaMin = $pengaturan->kuota_min ?? 2;
        $kuotaMax = $pengaturan->kuota_max ?? 5;
        // Daftar mahasiswa yang belum punya kelompok (selain user login)
        $daftarMahasiswa = \App\Models\Mahasiswa::whereNotIn('nim', \App\Models\Kelompok::pluck('nim'))
            ->where('nim', '!=', $user->nim)
            ->get();
        return view('mahasiswa.buat_topik', compact('fakultas', 'program_studi', 'bidangList', 'daftarMahasiswa', 'kuotaMin', 'kuotaMax'));
    }

    // Proses Mahasiswa Membuat Topik Sendiri
    public function buatTopik(Request $request) {
        $user = auth()->guard('mahasiswa')->user();
        if ($user && $user->wajib_ganti_password) {
            return redirect('/mahasiswa/ganti-password-awal');
        }
        // Cek apakah mahasiswa sudah punya topik/kelompok
        $sudah_punya = \App\Models\Kelompok::where('nim', $user->nim)->exists();
        if ($sudah_punya) {
            return redirect('/mahasiswa/daftar_topik')->with('error', 'Anda sudah memiliki topik/kelompok, tidak bisa membuat topik baru.');
        }
        $pengaturan = PengaturanTopik::first();
        $kuotaMin = $pengaturan->kuota_min ?? 2;
        $kuotaMax = $pengaturan->kuota_max ?? 5;
        $request->validate([
            'judul' => 'required|unique:daftar_topik,judul',
            'program_studi' => 'required',
            'fakultas' => 'required',
            'bidang' => 'required|array',
            'kuota' => 'required|numeric|min:'.$kuotaMin.'|max:'.$kuotaMax,
            'deskripsi' => 'required',
        ], [
            'judul.required' => 'Judul wajib diisi!',
            'judul.unique' => 'Judul sudah dipakai!',
            'program_studi.required' => 'Program Studi wajib diisi!',
            'fakultas.required' => 'Fakultas wajib diisi!',
            'bidang.required' => 'Bidang wajib diisi!',
            'kuota.required' => 'Kuota wajib diisi!',
            'kuota.min' => 'Kuota minimal '.$kuotaMin.' orang',
            'kuota.max' => 'Kuota maksimal '.$kuotaMax.' orang',
            'kuota.numeric' => 'Kuota harus angka',
            'deskripsi.required' => 'Deskripsi wajib diisi!',
        ]);
        \App\Models\DaftarTopik::create([
            'judul' => $request->judul,
            'program_studi' => $request->program_studi,
            'fakultas' => $request->fakultas,
            'bidang' => $request->bidang,
            'kuota' => $request->kuota,
            'dosen' => null,
            'kode_dosen' => null,
            'status' => 'Menunggu Pembimbing',
            'nim' => $user->nim,
            'kelompok' => $user->nim,
            'deskripsi' => $request->deskripsi,
        ]);
        // Tambahkan ke tabel kelompok untuk user login
        \App\Models\Kelompok::create([
            'judul' => $request->judul,
            'nim' => $user->nim,
            'nama_anggota' => $user->nama,
            'pembimbing_satu' => null,
        ]);
        // Tambahkan anggota tambahan jika ada
        if ($request->has('anggota_tambahan')) {
            foreach ($request->anggota_tambahan as $nimAnggota) {
                $mhs = \App\Models\Mahasiswa::where('nim', $nimAnggota)->first();
                if ($mhs) {
                    \App\Models\Kelompok::create([
                        'judul' => $request->judul,
                        'nim' => $mhs->nim,
                        'nama_anggota' => $mhs->nama,
                        'pembimbing_satu' => null,
                    ]);
                }
            }
        }
        return redirect('/mahasiswa/daftar_topik')->with('success', 'Topik berhasil diajukan, menunggu dosen pembimbing!');
    }

    public function hapusDokumen($id) {
        $user = auth()->guard('mahasiswa')->user();
        $dokumen = \App\Models\DokumenMahasiswa::where('id', $id)->where('nim', $user->nim)->firstOrFail();
        $dokumen->delete();
        return back()->with('success', 'Dokumen berhasil dihapus!');
    }

    /**
     * Mahasiswa membatalkan booking topik (Booked)
     */
    public function batalBooked($id)
    {
        $user = auth()->guard('mahasiswa')->user();
        if ($user && $user->wajib_ganti_password) {
            return redirect('/mahasiswa/ganti-password-awal');
        }
        $topik = \App\Models\DaftarTopik::findOrFail($id);
        $nim = $user->nim;
        // Hapus data kelompok mahasiswa pada topik ini
        $deleted = \App\Models\Kelompok::where('judul', $topik->judul)->where('nim', $nim)->delete();
        // Jika sudah tidak ada anggota, ubah status topik jadi Available
        $sisa_anggota = \App\Models\Kelompok::where('judul', $topik->judul)->count();
        if ($sisa_anggota == 0) {
            $topik->status = 'Available';
            $topik->save();
        }
        if ($deleted) {
            return back()->with('success', 'Booking topik berhasil dibatalkan.');
        } else {
            return back()->with('error', 'Gagal membatalkan booking topik.');
        }
    }

    /**
     * Mahasiswa membatalkan topik status Menunggu Pembimbing
     */
    public function batalMenunggu($id)
    {
        $user = auth()->guard('mahasiswa')->user();
        if ($user && $user->wajib_ganti_password) {
            return redirect('/mahasiswa/ganti-password-awal');
        }
        
        $topik = \App\Models\DaftarTopik::findOrFail($id);
        $nim = auth()->guard('mahasiswa')->user()->nim;
        
        // Pastikan mahasiswa login yang membuat topik ini
        if ($topik->nim_pembuat !== $nim) {
            return back()->with('error', 'Anda tidak berhak membatalkan topik ini!');
        }
        
        // Pastikan status masih "Menunggu Pembimbing"
        if ($topik->status !== 'Menunggu Pembimbing') {
            return back()->with('error', 'Topik tidak dapat dibatalkan karena status sudah berubah!');
        }
        
        // Hapus topik dan semua data kelompok terkait
        \App\Models\Kelompok::where('judul', $topik->judul)->delete();
        $topik->delete();
        
        return back()->with('success', 'Topik berhasil dibatalkan!');
    }

    /**
     * Edit foto mahasiswa
     */
    public function editFotoMahasiswa(Request $request, $id)
    {
        $user = auth()->guard('mahasiswa')->user();
        if ($user && $user->wajib_ganti_password) {
            return redirect('/mahasiswa/ganti-password-awal');
        }
        
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $mahasiswa = Mahasiswa::findOrFail($id);
        
        // Pastikan mahasiswa yang login yang mengedit
        if ($mahasiswa->id !== auth()->guard('mahasiswa')->user()->id) {
            return back()->with('error', 'Anda tidak berhak mengedit profil ini!');
        }

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(storage_path('app/public/assets/img/avatars'), $filename);
            
            // Hapus foto lama jika bukan default.jpg
            if ($mahasiswa->foto && $mahasiswa->foto !== 'default.jpg') {
                $oldPath = storage_path('app/public/assets/img/avatars/' . $mahasiswa->foto);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            
            $mahasiswa->foto = $filename;
            $mahasiswa->save();
        }

        return back()->with('success', 'Foto berhasil diperbarui!');
    }

    /**
     * Edit biodata mahasiswa
     */
    public function editBiodataMahasiswa(Request $request, $id)
    {
        $user = auth()->guard('mahasiswa')->user();
        if ($user && $user->wajib_ganti_password) {
            return redirect('/mahasiswa/ganti-password-awal');
        }
        
        $request->validate([
            'nim' => 'required|string|max:20|unique:mahasiswa,nim,' . $id,
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:mahasiswa,email,' . $id,
            'no_hp' => 'required|string|max:15',
        ]);

        $mahasiswa = Mahasiswa::findOrFail($id);
        
        // Pastikan mahasiswa yang login yang mengedit
        if ($mahasiswa->id !== auth()->guard('mahasiswa')->user()->id) {
            return back()->with('error', 'Anda tidak berhak mengedit profil ini!');
        }

        $mahasiswa->nim = $request->nim;
        $mahasiswa->nama = $request->nama;
        $mahasiswa->email = $request->email;
        $mahasiswa->no_hp = $request->no_hp;
        $mahasiswa->save();

        return back()->with('success', 'Biodata berhasil diperbarui!');
    }

    /**
     * Ganti kata sandi mahasiswa
     */
    public function gantiKataSandiMahasiswa(Request $request, $id)
    {
        $user = auth()->guard('mahasiswa')->user();
        if ($user && $user->wajib_ganti_password) {
            return redirect('/mahasiswa/ganti-password-awal');
        }
        
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:6|confirmed',
            'password_baru_confirmation' => 'required|min:6',
        ]);

        $mahasiswa = Mahasiswa::findOrFail($id);
        
        // Pastikan mahasiswa yang login yang mengedit
        if ($mahasiswa->id !== auth()->guard('mahasiswa')->user()->id) {
            return back()->with('error', 'Anda tidak berhak mengedit profil ini!');
        }

        // Cek password lama
        if (!password_verify($request->password_lama, $mahasiswa->password)) {
            return back()->withErrors(['password_lama' => 'Kata sandi lama tidak sesuai!']);
        }

        // Update password baru
        $mahasiswa->password = password_hash($request->password_baru, PASSWORD_DEFAULT);
        $mahasiswa->save();

        return back()->with('success', 'Kata sandi berhasil diperbarui!');
    }
}
