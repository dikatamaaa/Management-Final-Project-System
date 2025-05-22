<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index(){
        return view('index');
    }

    public function login(){
        if (Auth::guard('admin')->check()) {
            return redirect('/admin/beranda');
        }
    
        if (Auth::guard('mahasiswa')->check()) {
            return redirect('/mahasiswa/beranda');
        }
    
        if (Auth::guard('dosen')->check()) {
            return redirect('/dosen/beranda');
        }
        return view('login');
    }

######################### Halaman ADMIN ########################################
    public function berandaAdmin(){
        return view('admin.beranda');
    }

    public function templateDokumenAdmin(){
        return view('admin.template_dokumen');
    }

    public function mahasiswaAdmin(){
        return view('admin.mahasiswa');
    }

    public function dosenAdmin(){
        return view('admin.dosen');
    }

    public function profilAdmin(){
        return view('admin.profil');
    }
######################### Halaman ADMIN ########################################
######################### Halaman DOSEN ########################################
    public function berandaDosen() {
        return view('dosen.beranda');
    }
    public function daftarTopikDosen() {
        $kode_dosen = auth()->guard('dosen')->user()->kode_dosen;
        $menampilkanDataDaftarTopik = \App\Models\DaftarTopik::where('kode_dosen', $kode_dosen)->get();
        $modalTopik = \App\Models\DaftarTopik::all();
        return view('dosen.daftar_topik', compact('menampilkanDataDaftarTopik', 'modalTopik'));
    }
    public function templateLaporanDosen() {
        return view('dosen.template_laporan');
    }
    public function dokumenCdDosen() {
        return view('dosen.dokumen_cd');
    }
    public function progresTaDosen() {
        return view('dosen.progres_ta');
    }
    public function profilDosen() {
        return view('dosen.profil');
    }
######################### Halaman DOSEN ########################################
######################### Halaman MAHASIWA ########################################
    public function berandaMahasiswa() {
        return view('mahasiswa.beranda');
    }
    public function daftarTopikMahasiswa() {
        $daftarTopik = \App\Models\DaftarTopik::all();
        return view('mahasiswa.daftar_topik', compact('daftarTopik'));
    }
    public function pilihTopikMahasiswa(Request $request, $id) {
        $topik = \App\Models\DaftarTopik::findOrFail($id);
        $user = auth()->guard('mahasiswa')->user();
        $nim = $user->nim;
        $nama = $user->nama;

        // Cek apakah mahasiswa sudah punya kelompok/topik apapun
        $sudah_punya_kelompok = \App\Models\Kelompok::where('nim', $nim)->exists();
        if ($sudah_punya_kelompok) {
            return back()->with(['error' => 'Anda sudah memiliki kelompok/topik!']);
        }

        // Cek status topik
        if ($topik->status != 'Tersedia') {
            return back()->with(['error' => 'Topik ini tidak tersedia untuk dipilih!']);
        }

        // Booking: ubah status topik jadi Booked
        $topik->status = 'Booked';
        $topik->save();

        // Ambil nama dosen pembuat topik
        $dosen = \App\Models\Dosen::where('kode_dosen', $topik->kode_dosen)->first();
        $nama_pembimbing = $dosen ? $dosen->nama : null;

        // Tambahkan anggota ke tabel kelompok
        \App\Models\Kelompok::create([
            'judul' => $topik->judul,
            'nim' => $nim,
            'nama_anggota' => $nama,
            'pembimbing_satu' => $nama_pembimbing,
        ]);

        return back()->with(['success' => 'Topik berhasil di-booking! Silakan tambahkan anggota kelompok.']);
    }
    public function kelompokMahasiswa() {
        return view('mahasiswa.kelompok');
    }
######################### Halaman MAHASIWA ########################################
}
