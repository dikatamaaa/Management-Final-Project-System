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
        $daftarTopik = \App\Models\DaftarTopik::all();
        $jumlahTersedia = \App\Models\DaftarTopik::whereIn('status', ['Tersedia', 'Available'])->count();
        $jumlahDiambil = \App\Models\DaftarTopik::whereNotIn('status', ['Tersedia', 'Available'])->count();

        // Pie Chart: Proporsi Topik per Dosen
        $dosenTopik = \App\Models\DaftarTopik::whereNotNull('kode_dosen')
            ->selectRaw('kode_dosen, count(*) as total')
            ->groupBy('kode_dosen')
            ->pluck('total', 'kode_dosen')
            ->toArray();
        $pieLabels = array_keys($dosenTopik);
        $pieData = array_values($dosenTopik);

        // Bar Chart: Jumlah Topik per Bidang
        $bidangCounts = \App\Models\DaftarTopik::all()->flatMap(function($item) {
            return is_array($item->bidang) ? $item->bidang : [$item->bidang];
        })->countBy()->toArray();
        $barLabels = array_keys($bidangCounts);
        $barData = array_values($bidangCounts);

        // Line Chart: Progress Bimbingan per Dosen (dummy, sesuaikan jika ada model Bimbingan)
        $progressLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'];
        $progressData = [];
        $dosenList = $pieLabels;
        foreach ($dosenList as $dosen) {
            $progressData[$dosen] = [rand(0,2), rand(2,4), rand(3,5), rand(4,6), rand(5,7), rand(6,8)]; // Dummy, ganti dengan query asli jika ada
        }

        return view('dosen.beranda', compact(
            'daftarTopik', 'jumlahTersedia', 'jumlahDiambil',
            'pieLabels', 'pieData',
            'barLabels', 'barData',
            'progressLabels', 'progressData', 'dosenList'
        ));
    }
    public function daftarTopikDosen() {
        $kode_dosen = auth()->guard('dosen')->user()->kode_dosen;
        $menampilkanDataDaftarTopik = \App\Models\DaftarTopik::where('kode_dosen', $kode_dosen)->get();
        $modalTopik = \App\Models\DaftarTopik::all();
        return view('dosen.daftar_topik', compact('menampilkanDataDaftarTopik', 'modalTopik'));
    }
    public function templateLaporanDosen() {
        $templates = \App\Models\Template::all();
        return view('dosen.template_laporan', compact('templates'));
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
        $user = auth()->guard('mahasiswa')->user();
        if ($user && $user->wajib_ganti_password) {
            return redirect('/mahasiswa/ganti-password-awal');
        }
        // Komposisi Status Topik
        $statusLabels = ['Tersedia', 'Penuh', 'Proposal', 'TA', 'Booked'];
        $statusCounts = [
            // Gabungkan Tersedia+Available
            \App\Models\DaftarTopik::whereIn('status', ['Tersedia', 'Available'])->count(),
            // Gabungkan Penuh+Full
            \App\Models\DaftarTopik::whereIn('status', ['Penuh', 'Full'])->count(),
            \App\Models\DaftarTopik::where('status', 'Proposal')->count(),
            \App\Models\DaftarTopik::where('status', 'TA')->count(),
            \App\Models\DaftarTopik::where('status', 'Booked')->count(),
        ];
        // Jumlah Topik per Bidang
        $bidangCounts = \App\Models\DaftarTopik::all()->flatMap(function($item) {
            return is_array($item->bidang) ? $item->bidang : [$item->bidang];
        })->countBy()->toArray();
        $bidangLabels = array_keys($bidangCounts);
        $bidangData = array_values($bidangCounts);
        // Proporsi Topik per Dosen
        $dosenTopik = \App\Models\DaftarTopik::whereNotNull('kode_dosen')
            ->selectRaw('kode_dosen, count(*) as total')
            ->groupBy('kode_dosen')
            ->pluck('total', 'kode_dosen')
            ->toArray();
        $dosenLabels = array_keys($dosenTopik);
        $dosenData = array_values($dosenTopik);
        // Data Kelompok
        $kelompok = \App\Models\Kelompok::where('nim', $user->nim)->first();
        $pembimbingSatu = $kelompok->pembimbing_satu ?? '-';
        $pembimbingDua = $kelompok->pembimbing_dua ?? '-';
        $anggotaKelompok = [];
        $nims = [];
        if ($kelompok) {
            $anggotaKelompok = \App\Models\Kelompok::where('judul', $kelompok->judul)->get();
            $nims = $anggotaKelompok->pluck('nim')->toArray();
        }
        // Progress Bimbingan per Pembimbing 1 & 2 kelompok ini
        $progressLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'];
        $progressData = [];
        $pembimbingChartLabels = [];
        if ($pembimbingSatu && $pembimbingSatu != '-') {
            $pembimbingChartLabels[] = $pembimbingSatu;
            $progressData[$pembimbingSatu] = [];
            foreach (range(1, 6) as $bulan) {
                $progressData[$pembimbingSatu][] = \App\Models\Bimbingan::whereMonth('created_at', $bulan)
                    ->whereIn('nim', $nims)
                    ->where('pembimbing', 1)
                    ->count();
            }
        }
        if ($pembimbingDua && $pembimbingDua != '-') {
            $pembimbingChartLabels[] = $pembimbingDua;
            $progressData[$pembimbingDua] = [];
            foreach (range(1, 6) as $bulan) {
                $progressData[$pembimbingDua][] = \App\Models\Bimbingan::whereMonth('created_at', $bulan)
                    ->whereIn('nim', $nims)
                    ->where('pembimbing', 2)
                    ->count();
            }
        }
        return view('mahasiswa.beranda', compact(
            'statusLabels', 'statusCounts',
            'bidangLabels', 'bidangData',
            'dosenLabels', 'dosenData',
            'progressLabels', 'progressData',
            'pembimbingSatu', 'pembimbingDua',
            'anggotaKelompok', 'pembimbingChartLabels'
        ));
    }
    public function daftarTopikMahasiswa() {
        $user = auth()->guard('mahasiswa')->user();
        if ($user && $user->wajib_ganti_password) {
            return redirect('/mahasiswa/ganti-password-awal');
        }
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
        if ($topik->status != 'Available') {
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
        $user = auth()->guard('mahasiswa')->user();
        if ($user && $user->wajib_ganti_password) {
            return redirect('/mahasiswa/ganti-password-awal');
        }
        return view('mahasiswa.kelompok');
    }
    
    public function profilMahasiswa() {
        $user = auth()->guard('mahasiswa')->user();
        if ($user && $user->wajib_ganti_password) {
            return redirect('/mahasiswa/ganti-password-awal');
        }
        return view('mahasiswa.profil');
    }
######################### Halaman MAHASIWA ########################################
}
