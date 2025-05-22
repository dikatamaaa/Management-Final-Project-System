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
        // Validasi Form
        $validasi = Validator::make($request->all(), [
            'judul' => 'required|unique:daftar_topik,judul',
            'program_studi' => 'required',
            'fakultas' => 'required',
            'bidang' => 'required|array',
            'kuota' => 'required|numeric|min:2|max:5',
            'deskripsi' => 'required',
        ],[
            'judul.required' => 'Judul Wajib Diisi!',
            'judul.unique' => 'Judul Sudah Dipakai, Silahkan Coba Lagi!',
            'program_studi.required' => 'Program Studi Wajib Diisi!',
            'fakultas.required' => 'Fakultas Wajib Diisi!',
            'bidang.required' => 'Bidang Wajib Diisi!',
            'kuota.required' => 'Kuota Wajib Diisi!',
            'kuota.min' => 'Kuota Minimal 2 Orang',
            'kuota.max' => 'Kuota Maksimal 5 Orang',
            'kuota.numeric' => 'Kuota Harus Berjenis Angka',
            'deskripsi.required' => 'Deskripsi Wajib Diisi!',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withErrors($validasi)->with(['error' => 'Gagal Menambahkan Data!']);
        }

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
        // Attach anggota kelompok for each topik
        foreach ($menampilkanDataDaftarTopik as $topik) {
            $topik->anggota_kelompok = Kelompok::where('judul', $topik->judul)->get(['nama_anggota', 'nim']);
        }
        foreach ($modalTopik as $topik) {
            $topik->anggota_kelompok = Kelompok::where('judul', $topik->judul)->get(['nama_anggota', 'nim']);
        }
        foreach ($semuaTopik as $topik) {
            $topik->anggota_kelompok = Kelompok::where('judul', $topik->judul)->get(['nama_anggota', 'nim']);
        }
        $daftarMahasiswa = \App\Models\Mahasiswa::all(['nim', 'nama']);
        return view('dosen.daftar_topik', compact('menampilkanDataDaftarTopik','modalTopik','semuaTopik','daftarMahasiswa'));
    }

    /**
     * Hapus Data Daftar Topik
     */
    public function HapusDataDaftarTopik($id) : RedirectResponse {
        // Get Daftar Topik ID
        $daftar_topik = DaftarTopik::findOrFail($id);

        // Hapus Data Daftar Topik
        $daftar_topik->delete();

        // Kembali ke Halaman Daftar Topik
        return redirect('/dosen/daftar_topik')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    /**
     * Edit Data Daftar Topik
     */
    public function EditDataDaftarTopik(Request $request, $id) : RedirectResponse {
        // Validasi Form
        $validasi = Validator::make($request->all(), [
            'judul_'.$id => 'required|unique:daftar_topik,judul,'.$id.',id',
            'program_studi_'.$id => 'required',
            'fakultas_'.$id => 'required',
            'bidang_'.$id => 'required|array',
            'kuota_'.$id => 'required|numeric|min:2|max:5',
            'deskripsi_'.$id => 'required',
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

        // Perbarui Data Dosen
        $daftar_topik->update([
            'judul' => $request->input('judul_'.$id),
            'program_studi' => $request->input('program_studi_'.$id),
            'fakultas' => $request->input('fakultas_'.$id),
            'bidang' => $request->input('bidang_'.$id),
            'kuota' => $request->input('kuota_'.$id),
            'deskripsi' => $request->input('deskripsi_'.$id),
        ]);


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
        // Cek sudah ada di kelompok
        $sudah_ada = \App\Models\Kelompok::where('judul', $topik->judul)->where('nim', $request->nim)->exists();
        if ($sudah_ada) {
            return back()->with('error', 'Mahasiswa sudah ada di kelompok!');
        }
        // Tambahkan ke kelompok
        \App\Models\Kelompok::create([
            'judul' => $topik->judul,
            'nim' => $mahasiswa->nim,
            'nama_anggota' => $mahasiswa->nama,
        ]);
        // Kirim notifikasi ke mahasiswa
        $mahasiswa->notify(new PenambahanKelompokNotification($topik->judul));
        return back()->with('success', 'Mahasiswa berhasil ditambahkan ke kelompok!');
    }
}
