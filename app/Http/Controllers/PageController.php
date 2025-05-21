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
        return view('dosen.daftar_topik');
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
        return view('mahasiswa.daftar_topik');
    }
    public function kelompokMahasiswa() {
        return view('mahasiswa.kelompok');
    }
######################### Halaman MAHASIWA ########################################
}
