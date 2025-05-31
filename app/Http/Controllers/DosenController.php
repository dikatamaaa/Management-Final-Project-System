<?php

namespace App\Http\Controllers;

use App\Models\DaftarTopik;
use App\Models\Dosen;
use App\Models\Kelompok;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Notifications\PenambahanKelompokNotification;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use App\Models\PengaturanTopik;
use App\Models\RubrikPenilaian;

class DosenController extends Controller
{
    /**
     * Ganti Kata Sandi Dosen
     */
    public function GantiKataSandiDosen(Request $request, $id) : RedirectResponse {
        // Validasi input
        $validasi = Validator::make($request->all(), [
            'kata_sandi_lama' => 'required|min:8',
            'kata_sandi_baru' => 'required|min:8|different:kata_sandi_lama',
            'konfirmasi_kata_sandi' => 'required|same:kata_sandi_baru',
        ], [
            'kata_sandi_lama.required' => 'Kata Sandi Lama Wajib Diisi!',
            'kata_sandi_lama.min' => 'Kata Sandi Lama Minimal 8 Karakter',
            'kata_sandi_baru.required' => 'Kata Sandi Baru Wajib Diisi!',
            'kata_sandi_baru.min' => 'Kata Sandi Baru Minimal 8 karakter',
            'kata_sandi_baru.different' => 'Kata Sandi Baru Harus Berbeda Dengan Yang Lama',
            'konfirmasi_kata_sandi.required' => 'Konfirmasi Kata Sandi Wajib Diisi!',
            'konfirmasi_kata_sandi.same' => 'Konfirmasi Kata Sandi Tidak Sama',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withErrors($validasi)->with(['error' => 'Gagal Menambahkan Data!']);
        }

        //get Dosen by ID
        $dosen = Dosen::findOrFail($id);

        // Cek Apakah Kata Sandi Baru Sama Dengan Yang Lama
        if (Hash::check($request->input('kata_sandi_baru'), $dosen->kata_sandi)) {
            return back()->withErrors(['kata_sandi_baru' => 'Kata Sandi Baru Harus Berbeda Dengan Kata Sandi Saat Ini!'])->with(['error' => 'Kata Sandi Gagal Diperbarui!']);
        }

        // Verifikasi Kata Sandi Lama
        if (!Hash::check($request->kata_sandi_lama, $dosen->kata_sandi)) {
            return back()->withErrors(['kata_sandi_lama' => 'Kata Sandi Lama Tidak Sesuai!'])->with(['error' => 'Kata Sandi Gagal Diperbarui!']);
        }

        // Perbarui Kata Sandi
        $dosen->update([
            'kata_sandi' => Hash::make($request->kata_sandi_baru)
        ]);

        return redirect('/dosen/profil')->with(['success' => 'Kata Sandi Berhasil Diperbarui']);
    }

    /**
     * Edit Foto Dosen
     */
    public function EditFotoDosen(Request $request, $id) : RedirectResponse {
        // Validasi Form
        $validasi = Validator::make($request->all(), [
            'foto' => 'required|mimes:png,jpg,jpeg|max:16384',
        ],[
            'foto.required' => 'Foto Wajib Diisi!',
            'foto.mimes' => 'Jenis Foto Harus PNG, JPG, atau JPEG',
            'foto.max' => 'Ukuran Foto Maksimal 16MB',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withErrors($validasi)->with(['error' => 'Gagal Menambahkan Data!']);
        }

        //get Dosen by ID
        $dosen = Dosen::findOrFail($id);

        // Upload Foto
        $foto = $request->file('foto');
        $foto->storeAs('assets/img/avatars/'. $foto->hashName());

        // Hapus Foto Sebelumnya
        Storage::delete('assets/img/avatars/'.$dosen->image);

        // Update Foto Dosen
        $dosen->update([
            'foto' => $foto->hashName()
        ]);

        return redirect('/dosen/profil')->with(['success' => 'Foto Berhasil Diperbarui']);
    }

    /**
     * Edit Biodata Dosen
     */
    public function EditBiodataDosen(Request $request, $id) : RedirectResponse {
        // Validasi Form
        $validasi = Validator::make($request->all(), [
            'nip' => 'required|numeric|digits_between:8,20|unique:dosen,nip,'.$id.',id',
            'kode_dosen' => 'required|regex:/^[A-Z]+$/|max:3|unique:dosen,kode_dosen,'.$id.',id',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:dosen,email,'.$id.',id',
            'no_hp' => 'required|numeric|digits_between:10,15|unique:dosen,no_hp,'.$id.',id',
        ],[
            'nip.required' => 'NIP Wajib Diisi!',
            'nip.digits_between' => 'NIP Minimal Harus 8 Sampai 20 Digit',
            'nip.unique' => 'NIP Sudah Terpakai, Silahkan Coba Lagi!',
            'kode_dosen.required' => 'Kode Dosen Wajib Diisi!',
            'kode_dosen.regex' => 'Kode Dosen Harus Berjenis Huruf Kapital Saja',
            'kode_dosen.max' => 'Kode Dosen Harus 3 Digit Huruf',
            'kode_dosen.unique' => 'Kode Dosen Sudah Terpakai, Silahkan Coba Lagi!',
            'nama.required' => 'Nama Wajib Diisi!',
            'email.required' => 'Email Wajib Diisi!',
            'email.unique' => 'Email Sudah Terpakai, Silahkan Coba Lagi!',
            'no_hp.required' => 'No Handphone Wajib Diisi!',
            'no_hp.digits_between' => 'No Handphone Minimal 10 Digit Sampai 15 Digit',
            'no_hp.unique' => 'No Handphone Sudah Terpakai, Silahkan Coba Lagi!',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withErrors($validasi)->with(['error' => 'Gagal Diperbarui!']);
        }

        // Cek apakah nama Pengguna sudah ada di database
        if (Dosen::where('nama_pengguna', $request->nama_pengguna)->exists()) {
            return back()->withErrors(['nama_pengguna' => 'Nama Pengguna Sudah Ada, Silahkan Coba Lagi'])->with(['error' => 'Gagal Menambahkan Data!']);
        }

        // Get Dosen by ID
        $dosen = Dosen::findOrFail($id);

        // Perbarui Data Dosen
        $dosen->update([
            'nip' => $request->input('nip'),
            'kode_dosen' => $request->input('kode_dosen'),
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'no_hp' => $request->input('no_hp'),
        ]);

        // Redirect ke Halaman Profil
        return redirect('/dosen/profil')->with(['success' => 'Data Berhasil Diperbarui!']);
    }

    /**
     * Menambahkan Data Daftar Topik
     */
    public function TambahDataDaftarTopik(Request $request) : RedirectResponse {
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

        // Ambil Data Dosen
        $nama_dosen = auth()->guard('dosen')->user()->nama;
        $kode_dosen = auth()->guard('dosen')->user()->kode_dosen;

        // Simpan Data Daftar Topik
        $daftar_topik = DaftarTopik::create([
            'judul' => $request->judul,
            'program_studi' => $request->program_studi,
            'fakultas' => $request->fakultas,
            'bidang' => $request->bidang,
            'kuota' => $request->kuota,
            'dosen' => $nama_dosen,
            'kode_dosen' => $kode_dosen,
            'status' => 'Tersedia',
            'nim' => null,
            'kelompok' => null,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect('dosen/daftar_topik')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Menampilkan Data Daftar Topik
     */
    public function MenampilkanDataDaftarTopik() : View {
        $kode_dosen = auth()->guard('dosen')->user()->kode_dosen;
        $menampilkanDataDaftarTopik = DaftarTopik::where('kode_dosen', $kode_dosen)->get();
        $modalTopik = DaftarTopik::all();
        $semuaTopik = DaftarTopik::all();
        // Topik dari mahasiswa (belum ada pembimbing)
        $topikMahasiswa = DaftarTopik::whereNull('kode_dosen')->where('status', 'Menunggu Pembimbing')->get();
        // Pengaturan admin
        $pengaturan = \App\Models\PengaturanTopik::first();
        $bidangList = $pengaturan->list_bidang ?? [];
        $kuotaMin = $pengaturan->kuota_min ?? 2;
        $kuotaMax = $pengaturan->kuota_max ?? 5;
        // Daftar mahasiswa yang belum punya kelompok/topik
        $daftarMahasiswa = \App\Models\Mahasiswa::whereNotIn('nim', Kelompok::pluck('nim'))->get(['nim', 'nama']);
        // Attach anggota kelompok for each topik
        foreach ($menampilkanDataDaftarTopik as $topik) {
            $topik->anggota_kelompok = Kelompok::where('judul', $topik->judul)->get(['nama_anggota', 'nim']);
        }
        foreach ($modalTopik as $topik) {
            $topik->anggota_kelompok = Kelompok::where('judul', $topik->judul)->get(['nama_anggota', 'nim']);
        }
        return view('dosen.daftar_topik', compact('menampilkanDataDaftarTopik', 'modalTopik', 'semuaTopik', 'topikMahasiswa', 'bidangList', 'kuotaMin', 'kuotaMax', 'daftarMahasiswa'));
    }

    /**
     * Hapus Data Daftar Topik
     */
    public function HapusDataDaftarTopik($id) : RedirectResponse {
        // Get Daftar Topik ID
        $daftar_topik = DaftarTopik::findOrFail($id);
        // Hapus semua bimbingan yang terkait topik ini
        \App\Models\Bimbingan::where('judul', $daftar_topik->judul)->delete();
        // Hapus semua anggota kelompok yang terkait topik ini
        \App\Models\Kelompok::where('judul', $daftar_topik->judul)->delete();
        // Hapus Data Daftar Topik
        $daftar_topik->delete();
        // Kembali ke Halaman Daftar Topik
        return redirect('/dosen/daftar_topik')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    /**
     * Edit Data Daftar Topik
     */
    public function EditDataDaftarTopik(Request $request, $id) : RedirectResponse {
        // Jika bidang tidak ada di request, isi dengan data lama dari database
        if (!$request->has('bidang_'.$id)) {
            $daftar_topik = DaftarTopik::findOrFail($id);
            $request->merge(['bidang_'.$id => $daftar_topik->bidang ?? []]);
        }
        // Perbaiki bidang[] agar tidak error jika hanya hidden input yang terkirim
        $bidang = $request->input('bidang_'.$id);
        if (is_array($bidang)) {
            $bidang = array_filter($bidang, function($v) { return $v !== null && $v !== ''; });
            if (empty($bidang)) {
                $request->request->remove('bidang_'.$id);
            } else {
                $request->merge(['bidang_'.$id => $bidang]);
            }
        }
        // Validasi Form
        $validasi = Validator::make($request->all(), [
            'judul_'.$id => 'required|unique:daftar_topik,judul,'.$id.',id',
            'program_studi_'.$id => 'required',
            'fakultas_'.$id => 'required',
            'bidang_'.$id => 'required|array',
            'kuota_'.$id => 'required|numeric|min:2|max:5',
            'deskripsi_'.$id => 'required',
            // status hanya divalidasi jika status sebelumnya Proposal
        ],[
            'judul_'.$id.'.required' => 'Judul Wajib Diisi!',
            'judul_'.$id.'.unique' => 'Judul Sudah Dipakai, Silahkan Coba Lagi!',
            'program_studi_'.$id.'.required' => 'Program Studi Wajib Diisi!',
            'fakultas_'.$id.'.required' => 'Fakultas Wajib Diisi!',
            'bidang_'.$id.'.required' => 'Bidang Wajib Diisi!',
            'kuota_'.$id.'.required' => 'Kuota Wajib Diisi!',
            'kuota_'.$id.'.min' => 'Kuota Minimal 2 Orang',
            'kuota_'.$id.'.max' => 'Kuota Maksimal 5 Orang',
            'kuota_'.$id.'.numeric' => 'Kuota Harus Berjenis Angka',
            'deskripsi_'.$id.'.required' => 'Deskripsi Wajib Diisi!',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withErrors($validasi)->with(['error' => 'Gagal Menambahkan Data!']);
        }

        // Get Daftar Topik by ID
        $daftar_topik = DaftarTopik::findOrFail($id);

        // Siapkan data update
        $updateData = [
            'judul' => $request->input('judul_'.$id),
            'program_studi' => $request->input('program_studi_'.$id),
            'fakultas' => $request->input('fakultas_'.$id),
            'bidang' => $request->input('bidang_'.$id),
            'kuota' => $request->input('kuota_'.$id),
            'deskripsi' => $request->input('deskripsi_'.$id),
        ];
        // Jika status sebelumnya Proposal, izinkan edit status
        if ($daftar_topik->status === 'Proposal' && $request->has('status_'.$id)) {
            $updateData['status'] = $request->input('status_'.$id);
        }
        // Perbarui Data Dosen
        $daftar_topik->update($updateData);

        // Redirect ke Halaman Daftar Topik
        return redirect('/dosen/daftar_topik')->with(['success' => 'Data Berhasil Diperbarui!']);
    }

    public function UbahStatusTopik(Request $request, $id)
    {
        $topik = \App\Models\DaftarTopik::findOrFail($id);
        $topik->status = $request->status;
        $topik->save();
        return back()->with('success', 'Status topik berhasil diubah!');
    }

    public function TambahMahasiswaKeTopik(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required|exists:mahasiswa,nim',
        ]);
        $topik = \App\Models\DaftarTopik::findOrFail($id);
        $mahasiswa = \App\Models\Mahasiswa::where('nim', $request->nim)->first();
        // Cek kuota
        $jumlah_anggota = \App\Models\Kelompok::where('judul', $topik->judul)->count();
        if ($jumlah_anggota >= $topik->kuota) {
            return back()->with('error', 'Kuota topik sudah penuh!');
        }
        // Cek apakah mahasiswa sudah punya kelompok/topik apapun
        $sudah_punya_kelompok = \App\Models\Kelompok::where('nim', $request->nim)->exists();
        if ($sudah_punya_kelompok) {
            return back()->with('error', 'Mahasiswa ini sudah memiliki kelompok/topik!');
        }
        // Tambahkan ke kelompok
        \App\Models\Kelompok::create([
            'judul' => $topik->judul,
            'nim' => $mahasiswa->nim,
            'nama_anggota' => $mahasiswa->nama,
            'pembimbing_satu' => $topik->dosen,
            'pembimbing_dua' => null,
            'status_pembimbing_dua' => null,
            'alasan_tolak_pembimbing_dua' => null,
        ]);
        // Jika status topik sebelumnya 'Tersedia', ubah ke 'Booked'
        if ($topik->status == 'Tersedia') {
            $topik->status = 'Booked';
            $topik->save();
        }
        // Cek apakah setelah penambahan, kelompok sudah penuh
        $jumlah_anggota_baru = \App\Models\Kelompok::where('judul', $topik->judul)->count();
        if ($jumlah_anggota_baru >= $topik->kuota) {
            $topik->status = 'Full';
            $topik->save();
        }
        // Kirim notifikasi ke mahasiswa
        $mahasiswa->notify(new PenambahanKelompokNotification($topik->judul));
        return back()->with('success', 'Mahasiswa berhasil ditambahkan ke kelompok!');
    }

    /**
     * Menampilkan permintaan pembimbing dua yang masuk ke dosen ini
     */
    public function permintaanPembimbingDua() {
        $nama_dosen = auth()->guard('dosen')->user()->nama;
        // Ambil semua judul kelompok yang meminta dosen ini sebagai pembimbing dua dan status pending
        $judulList = \App\Models\Kelompok::where('pembimbing_dua', $nama_dosen)
            ->where('status_pembimbing_dua', 'pending')
            ->pluck('judul')
            ->unique();
        $permintaan = [];
        foreach ($judulList as $judul) {
            $anggota = \App\Models\Kelompok::where('judul', $judul)->get();
            $row = [
                'judul' => $judul,
                'anggota' => $anggota,
                'pembimbing_satu' => $anggota->first()->pembimbing_satu ?? '-',
                'id' => $anggota->first()->id ?? null,
            ];
            $permintaan[] = $row;
        }
        return view('dosen.pembimbing-dua', compact('permintaan'));
    }

    /**
     * Menerima permintaan pembimbing dua
     */
    public function acceptPembimbingDua($id) {
        $kelompok = \App\Models\Kelompok::findOrFail($id);
        // Update semua anggota kelompok dengan judul yang sama
        \App\Models\Kelompok::where('judul', $kelompok->judul)
            ->update([
                'status_pembimbing_dua' => 'accepted',
                'alasan_tolak_pembimbing_dua' => null
            ]);
        // Kirim notifikasi ke semua anggota kelompok
        $anggota = \App\Models\Kelompok::where('judul', $kelompok->judul)->get();
        foreach ($anggota as $item) {
            $mahasiswa = \App\Models\Mahasiswa::where('nim', $item->nim)->first();
            if ($mahasiswa) {
                $mahasiswa->notify(new \App\Notifications\PembimbingDuaNotification('accepted', $kelompok->pembimbing_dua));
            }
        }
        return back()->with('success', 'Permintaan pembimbing dua diterima.');
    }

    /**
     * Menolak permintaan pembimbing dua
     */
    public function rejectPembimbingDua(Request $request, $id) {
        $kelompok = \App\Models\Kelompok::findOrFail($id);
        // Update semua anggota kelompok dengan judul yang sama
        \App\Models\Kelompok::where('judul', $kelompok->judul)
            ->update([
                'status_pembimbing_dua' => 'rejected',
                'alasan_tolak_pembimbing_dua' => $request->alasan
            ]);
        // Kirim notifikasi ke semua anggota kelompok
        $anggota = \App\Models\Kelompok::where('judul', $kelompok->judul)->get();
        foreach ($anggota as $item) {
            $mahasiswa = \App\Models\Mahasiswa::where('nim', $item->nim)->first();
            if ($mahasiswa) {
                $mahasiswa->notify(new \App\Notifications\PembimbingDuaNotification('rejected', $kelompok->pembimbing_dua, $request->alasan));
            }
        }
        return back()->with('success', 'Permintaan pembimbing dua ditolak.');
    }

    /**
     * Halaman daftar pengajuan bimbingan ke dosen ini
     */
    public function halamanBimbingan() {
        $nama_dosen = auth()->guard('dosen')->user()->nama;
        // Ambil semua kelompok yang dosen ini jadi pembimbing satu atau dua
        $kelompokPemb1 = \App\Models\Kelompok::where('pembimbing_satu', $nama_dosen)->pluck('nim') ?? collect();
        $kelompokPemb2 = \App\Models\Kelompok::where('pembimbing_dua', $nama_dosen)->where('status_pembimbing_dua', 'accepted')->pluck('nim') ?? collect();
        if (!$kelompokPemb1) $kelompokPemb1 = collect();
        if (!$kelompokPemb2) $kelompokPemb2 = collect();
        $bimbinganList = \App\Models\Bimbingan::where(function($q) use ($kelompokPemb1, $kelompokPemb2) {
            $q->where(function($q2) use ($kelompokPemb1) {
                $q2->where('pembimbing', '1')->whereIn('nim', $kelompokPemb1);
            })->orWhere(function($q2) use ($kelompokPemb2) {
                $q2->where('pembimbing', '2')->whereIn('nim', $kelompokPemb2);
            });
        })->orderByDesc('created_at')->get();
        $mahasiswaNama = \App\Models\Mahasiswa::pluck('nama','nim');
        // Ambil judul kelompok untuk setiap nim
        $kelompokJudulList = \App\Models\Kelompok::pluck('judul','nim');
        return view('dosen.bimbingan', compact('bimbinganList', 'mahasiswaNama', 'nama_dosen', 'kelompokJudulList'));
    }

    /**
     * ACC bimbingan
     */
    public function accBimbingan($id) {
        $bimbingan = \App\Models\Bimbingan::findOrFail($id);
        $bimbingan->status = 'accepted';
        $bimbingan->save();
        // (opsional) notifikasi ke mahasiswa
        return back()->with('success', 'Bimbingan diterima!');
    }

    /**
     * Reject bimbingan
     */
    public function rejectBimbingan(Request $request, $id) {
        $bimbingan = \App\Models\Bimbingan::findOrFail($id);
        $bimbingan->status = 'rejected';
        $bimbingan->alasan_tolak = $request->alasan_tolak;
        $bimbingan->save();
        // (opsional) notifikasi ke mahasiswa
        return back()->with('success', 'Bimbingan ditolak!');
    }

    /**
     * Kritik & Saran setelah bimbingan selesai
     */
    public function kritikSaranBimbingan(Request $request, $id) {
        $bimbingan = \App\Models\Bimbingan::findOrFail($id);
        $bimbingan->kritik_saran = $request->kritik_saran;
        $bimbingan->status = 'selesai';
        $bimbingan->save();
        // (opsional) notifikasi ke mahasiswa
        return back()->with('success', 'Kritik & saran berhasil diberikan!');
    }

    /**
     * Halaman penilaian kelompok dan anggota (pembimbing 1 & 2)
     */
    public function halamanPenilaianKelompok() {
        $nama_dosen = auth()->guard('dosen')->user()->nama;
        $dosen_id = auth()->guard('dosen')->user()->id;
        // Kelompok di mana dosen ini sebagai pembimbing satu
        $kelompokPemb1 = \App\Models\Kelompok::where('pembimbing_satu', $nama_dosen)->get()->groupBy('judul');
        // Kelompok di mana dosen ini sebagai pembimbing dua (dan sudah accepted)
        $kelompokPemb2 = \App\Models\Kelompok::where('pembimbing_dua', $nama_dosen)
            ->where('status_pembimbing_dua', 'accepted')
            ->get()->groupBy('judul');
        // Ambil penilaian per anggota dan kelompok
        $penilaian = \App\Models\PenilaianMahasiswa::whereIn('kelompok_judul', array_merge($kelompokPemb1->keys()->toArray(), $kelompokPemb2->keys()->toArray()))->get();
        // Ambil rubrik penilaian milik dosen
        $rubrik = \App\Models\RubrikPenilaian::where('dosen_id', $dosen_id)->orderBy('cd')->orderBy('urutan')->get();
        return view('dosen.penilaian_kelompok', compact('kelompokPemb1', 'kelompokPemb2', 'nama_dosen', 'penilaian', 'rubrik'));
    }

    /**
     * Simpan penilaian mahasiswa oleh dosen (per kelompok)
     */
    public function storePenilaianMahasiswa(Request $request) {
        $request->validate([
            'kelompok_judul' => 'required|string',
            'pembimbing' => 'required|in:1,2',
            'anggota' => 'required|array',
        ]);
        $dosen_nama = auth()->guard('dosen')->user()->nama;

        // Simpan penilaian kelompok (aspek tipe 'kelompok')
        if ($request->has('kelompok_rubrik')) {
            foreach ($request->kelompok_rubrik as $aspek_id => $nilai) {
                \App\Models\PenilaianMahasiswa::updateOrCreate(
                    [
                        'nim' => null,
                        'kelompok_judul' => $request->kelompok_judul,
                        'pembimbing' => $request->pembimbing,
                        'dosen_nama' => $dosen_nama,
                        'rubrik_id' => $aspek_id,
                    ],
                    [
                        'nilai' => $nilai,
                    ]
                );
            }
        }

        // Simpan penilaian individu (aspek tipe 'individu')
        foreach ($request->anggota as $anggota) {
            $nim = $anggota['nim'];
            if (isset($anggota['nilai_rubrik'])) {
                foreach ($anggota['nilai_rubrik'] as $aspek_id => $nilai) {
                    \App\Models\PenilaianMahasiswa::updateOrCreate(
                        [
                            'nim' => $nim,
                            'kelompok_judul' => $request->kelompok_judul,
                            'pembimbing' => $request->pembimbing,
                            'dosen_nama' => $dosen_nama,
                            'rubrik_id' => $aspek_id,
                        ],
                        [
                            'nilai' => $nilai,
                        ]
                    );
                }
            }
        }

        return back()->with('success', 'Penilaian kelompok dan anggota berhasil disimpan!');
    }

    /**
     * Export rekap penilaian ke .csv (per rubrik, dinamis)
     */
    public function exportPenilaianCsv(Request $request) {
        $nama_dosen = auth()->guard('dosen')->user()->nama;
        $dosen_id = auth()->guard('dosen')->user()->id;
        $pembimbing = $request->query('pembimbing');
        $penilaianQuery = \App\Models\PenilaianMahasiswa::where('dosen_nama', $nama_dosen);
        if ($pembimbing == '1' || $pembimbing == '2') {
            $penilaianQuery = $penilaianQuery->where('pembimbing', $pembimbing);
        }
        $penilaian = $penilaianQuery->get();
        $rubrik = \App\Models\RubrikPenilaian::where('dosen_id', $dosen_id)->orderBy('cd')->orderBy('urutan')->get();

        // Ambil semua kelompok yang dinilai dosen ini (berdasarkan penilaian)
        $kelompokJudul = $penilaian->pluck('kelompok_judul')->unique();
        $data = [];
        $header = ['Judul','Sebagai Pembimbing','Pembimbing','NIM','Nama Anggota'];
        // Tambahkan header per aspek (dinamis)
        foreach ($rubrik as $aspek) {
            $label = $aspek->aspek . ' (' . ucfirst($aspek->tipe) . ')';
            $header[] = 'Nilai ' . $label;
        }

        // Loop semua kelompok dan anggota
        foreach ($kelompokJudul as $judul) {
            // Cek pembimbing yang relevan
            $pembimbingList = $penilaian->where('kelompok_judul', $judul)->pluck('pembimbing')->unique();
            foreach ($pembimbingList as $pemb) {
                // Ambil semua anggota kelompok
                $anggota = \App\Models\Kelompok::where('judul', $judul)->get();
                foreach ($anggota as $mhs) {
                    $row = [
                        $judul,
                        $pemb,
                        $pemb . ' - ' . $nama_dosen,
                        $mhs->nim,
                        $mhs->nama_anggota,
                    ];
                    foreach ($rubrik as $aspek) {
                        if ($aspek->tipe == 'kelompok') {
                            // Nilai kelompok (nim = null)
                            $nilai = $penilaian->where('kelompok_judul', $judul)
                                ->where('pembimbing', $pemb)
                                ->where('nim', null)
                                ->where('rubrik_id', $aspek->id)
                                ->first();
                            $row[] = $nilai ? $nilai->nilai : '';
                        } else {
                            // Nilai individu (nim = nim anggota)
                            $nilai = $penilaian->where('kelompok_judul', $judul)
                                ->where('pembimbing', $pemb)
                                ->where('nim', $mhs->nim)
                                ->where('rubrik_id', $aspek->id)
                                ->first();
                            $row[] = $nilai ? $nilai->nilai : '';
                        }
                    }
                    $data[] = $row;
                }
            }
        }

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="rekap_penilaian.csv"',
        ];
        $callback = function() use ($header, $data) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $header);
            foreach ($data as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
        };
        return response()->streamDownload($callback, 'rekap_penilaian.csv', $headers);
    }

    // Dosen mengambil topik mahasiswa (jadi pembimbing satu)
    public function ambilTopikMahasiswa($id) {
        $topik = \App\Models\DaftarTopik::findOrFail($id);
        if ($topik->status !== 'Menunggu Pembimbing') {
            return back()->with('error', 'Topik ini sudah diambil dosen lain atau sudah ada pembimbing!');
        }
        $dosen = auth()->guard('dosen')->user();
        $topik->dosen = $dosen->nama;
        $topik->kode_dosen = $dosen->kode_dosen;
        $topik->status = 'Sudah Ada Pembimbing';
        $topik->save();
        // Update pembimbing_satu di semua anggota kelompok dengan judul yang sama
        \App\Models\Kelompok::where('judul', $topik->judul)->update(['pembimbing_satu' => $dosen->nama]);
        return back()->with('success', 'Anda berhasil mengambil topik ini sebagai pembimbing!');
    }
}

