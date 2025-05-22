<?php

use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\KelompokController;

// Landing Page
Route::get('/', [PageController::class, 'index']);

// Form Login
Route::get('/login', [PageController::class, 'login'])->name('login')->middleware('guest:admin,mahasiswa,dosen');

// Submit Login
Route::post('/login', [LoginController::class, 'login'])->name('login.submit')->middleware('guest:admin,mahasiswa,dosen');

// Logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout.get');


// Menuju Halaman Masing - Masing Role
// Admin
Route::get('/admin/beranda', [PageController::class, 'berandaAdmin'])->middleware('auth:admin');
Route::get('/admin/template_dokumen', [PageController::class, 'templateDokumenAdmin'])->middleware('auth:admin');
Route::get('/admin/mahasiswa', [PageController::class, 'mahasiswaAdmin'])->middleware('auth:admin');
Route::get('/admin/dosen', [PageController::class, 'dosenAdmin'])->middleware('auth:admin');
Route::get('/admin/profil', [PageController::class, 'profilAdmin'])->middleware('auth:admin');
Route::get('/download/{filename}', function ($filename) {
    $path = storage_path('app/public/dokumen_template/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->download($path);
});

// Admin Notifikasi
Route::post('/notification/{id}/read', function ($id) {
    $notification = \Illuminate\Support\Facades\DB::table('notifications')->where('id', $id);
    $notification->update([
        'read_at' => \Illuminate\Support\Facades\DB::raw('CURRENT_TIMESTAMP'),
    ]);

    $dataArray = json_decode($notification->firstOrFail()->data, true);

    if (isset($dataArray['template_dokumen_id'])) {
        return redirect('/admin/template_dokumen');
    }
    return back();
})->middleware('auth:admin');
Route::post('/admin/notifications/sudah-dibaca', [AdminController::class, 'SudahDibaca'])->name('admin.notifications.read')->middleware('auth:admin');
Route::post('/admin/notifications/hapus-semua', [AdminController::class, 'HapusSemua'])->name('admin.notifications.drop')->middleware('auth:admin');

// CRUD Pada Role Admin
Route::get('/admin/beranda', [AdminController::class, 'JumlahData'])->middleware('auth:admin');

Route::post('/admin/template_dokumen', [AdminController::class, 'TambahDataDokumenTemplate'])->name('template.tambah')->middleware('auth:admin');
Route::get('/admin/template_dokumen', [AdminController::class, 'MenampilkanDataDokumenTemplate'])->middleware('auth:admin');
Route::get('/admin/template_dokumen/hapus/{id}', [AdminController::class, 'HapusDataDokumenTemplate'])->name('template.hapus')->middleware('auth:admin');
Route::post('/admin/template_dokumen/edit/{id}', [AdminController::class, 'EditDataDokumenTemplate'])->name('template.edit')->middleware('auth:admin');

Route::post('/admin/dosen', [AdminController::class, 'TambahDataDosen'])->name('dosen.tambah')->middleware('auth:admin');
Route::get('/admin/dosen', [AdminController::class, 'MenampilkanDataDosen'])->middleware('auth:admin');
Route::post('/admin/dosen/edit/{id}', [AdminController::class, 'EditDataDosen'])->name('dosen.edit')->middleware('auth:admin');
Route::get('/admin/dosen/hapus/{id}', [AdminController::class, 'HapusDataDosen'])->name('dosen.hapus')->middleware('auth:admin');
Route::post('/admin/dosen/GantiKataSandi/{id}', [AdminController::class, 'GantiKataSandiDosen'])->name('dosen.GantiKataSandi')->middleware('auth:admin');

Route::post('/admin/mahasiswa', [AdminController::class, 'TambahDataMahasiswa'])->name('mahasiswa.tambah')->middleware('auth:admin');
Route::get('/admin/mahasiswa', [AdminController::class, 'MenampilkanDataMahasiswa'])->middleware('auth:admin');
Route::post('/admin/mahasiswa/edit/{id}', [AdminController::class, 'EditDataMahasiswa'])->name('mahasiswa.edit')->middleware('auth:admin');
Route::get('/admin/mahasiswa/hapus/{id}', [AdminController::class, 'HapusDataMahasiswa'])->name('mahasiswa.hapus')->middleware('auth:admin');
Route::post('/admin/mahasiswa/GantiKataSandi/{id}', [AdminController::class, 'GantiKataSandiMahasiswa'])->name('mahasiswa.GantiKataSandi')->middleware('auth:admin');

Route::post('/admin/profil/editFoto/{id}', [AdminController::class, 'EditFotoAdmin'])->name('admin.editFoto')->middleware('auth:admin');
Route::post('/admin/profil/gantiKataSandi/{id}', [AdminController::class, 'GantiKataSandiAdmin'])->name('admin.gantiKataSandi')->middleware('auth:admin');

#########################################################################################################################################################################################

// Dosen
Route::get('/dosen/beranda', [PageController::class, 'berandaDosen'])->middleware('auth:dosen');
Route::get('/dosen/daftar_topik', [PageController::class, 'daftarTopikDosen'])->middleware('auth:dosen');
Route::get('/dosen/template_laporan', [PageController::class, 'templateLaporanDosen'])->middleware('auth:dosen');
Route::get('/dosen/dokumen_cd', [PageController::class, 'dokumenCdDosen'])->middleware('auth:dosen');
Route::get('/dosen/progres_ta', [PageController::class, 'progresTaDosen'])->middleware('auth:dosen');
Route::get('/dosen/profil', [PageController::class, 'profilDosen'])->middleware('auth:dosen');

// CRUD Pada Role Dosen
Route::post('/dosen/daftar_topik', [DosenController::class, 'TambahDataDaftarTopik'])->name('daftar_topik.tambah')->middleware('auth:dosen');
Route::get('/dosen/daftar_topik', [DosenController::class, 'MenampilkanDataDaftarTopik'])->middleware('auth:dosen');
Route::get('/dosen/daftar_topik/hapus/{id}', [DosenController::class, 'HapusDataDaftarTopik'])->name('daftar_topik.hapus')->middleware('auth:dosen');
Route::post('/dosen/daftar_topik/edit/{id}', [DosenController::class, 'EditDataDaftarTopik'])->name('daftar_topik.edit')->middleware('auth:dosen');
Route::post('/dosen/daftar_topik/ubah_status/{id}', [DosenController::class, 'UbahStatusTopik'])->name('daftar_topik.ubah_status')->middleware('auth:dosen');
Route::post('/dosen/daftar_topik/tambah_mahasiswa/{id}', [DosenController::class, 'TambahMahasiswaKeTopik'])->name('daftar_topik.tambah_mahasiswa')->middleware('auth:dosen');

Route::post('/dosen/profil/editFoto/{id}', [DosenController::class, 'EditFotoDosen'])->name('dosen.editFoto')->middleware('auth:dosen');
Route::post('/dosen/profil/editBiodata/{id}', [DosenController::class, 'EditBiodataDosen'])->name('dosen.editBiodata')->middleware('auth:dosen');
Route::post('/dosen/profil/gantiKataSandi/{id}', [DosenController::class, 'GantiKataSandiDosen'])->name('dosen.gantiKataSandi')->middleware('auth:dosen');

#########################################################################################################################################################################################

// Mahasiswa
Route::get('/mahasiswa/beranda', [PageController::class, 'berandaMahasiswa'])->middleware('auth:mahasiswa');
Route::get('/mahasiswa/daftar_topik', [PageController::class, 'daftarTopikMahasiswa'])->middleware('auth:mahasiswa');
Route::get('/mahasiswa/kelompok', [PageController::class, 'kelompokMahasiswa'])->middleware('auth:mahasiswa');
Route::get('/mahasiswa/template_laporan', [MahasiswaController::class, 'TemplateLaporan'])->name('mahasiswa.template_laporan')->middleware('auth:mahasiswa');


// CRUD Pada Role Mahasiwa
Route::get('/mahasiswa/pembimbing-dua', [MahasiswaController::class, 'dataMahasiswa'])->middleware('auth:mahasiswa');
Route::post('/mahasiswa/daftar_topik/pilih/{id}', [PageController::class, 'pilihTopikMahasiswa'])->name('mahasiswa.pilih_topik')->middleware('auth:mahasiswa');

Route::post('/kelompok/terima', [KelompokController::class, 'terima'])->name('kelompok.terima');
Route::post('/kelompok/tolak', [KelompokController::class, 'tolak'])->name('kelompok.tolak');

Route::post('/mahasiswa/notifications/read-all', function () {
    auth()->guard('mahasiswa')->user()->unreadNotifications->markAsRead();
    return response()->json(['success' => true]);
})->name('mahasiswa.notifications.read')->middleware('auth:mahasiswa');

Route::post('/mahasiswa/pilih-pembimbing-dua', [MahasiswaController::class, 'pilihPembimbingDua'])->name('mahasiswa.pilih_pembimbing_dua');
Route::post('/mahasiswa/daftar_topik/tambah_anggota/{id}', [MahasiswaController::class, 'tambahAnggotaKelompok'])->name('mahasiswa.tambah_anggota_kelompok');
