<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request) {
        $request->validate([
            'nama_pengguna' => 'required|string',
            'kata_sandi' => 'required|string|min:8',
        ],[
            'nama_pengguna.required' => 'Nama Pengguna Wajib Diisi!.',
            'kata_sandi.required' => 'Kata Sandi Wajib Diisi!.',
            'kata_sandi.min' => 'Kata Sandi Minimal 8 Karakter',
        ]);

        $nama_pengguna = $request->nama_pengguna;
        $kata_sandi = $request->kata_sandi;

        // Cek Admin
        $admin = Admin::where('nama_pengguna', $nama_pengguna)->first();
        if ($admin && Hash::check($kata_sandi, $admin->kata_sandi)) {
            Auth::guard('admin')->login($admin);
            return redirect()->intended('/admin/beranda');
        }

        // Cek Mahasiswa
        $mahasiswa = Mahasiswa::where('nama_pengguna', $nama_pengguna)->first();
        if ($mahasiswa && Hash::check($kata_sandi, $mahasiswa->kata_sandi)) {
            Auth::guard('mahasiswa')->login($mahasiswa);
            return redirect()->intended('/mahasiswa/beranda');
        }

        // Cek Dosen
        $dosen = Dosen::where('nama_pengguna', $nama_pengguna)->first();
        if ($dosen && Hash::check($kata_sandi, $dosen->kata_sandi)) {
            Auth::guard('dosen')->login($dosen);
            return redirect()->intended('/dosen/beranda');
        }

        // Gagal Login
        return back()->withErrors([
            'login' => 'Nama Pengguna dan Kata Sandi Salah!,',
            'login2' => ' Silahkan Ulangi Lagi.'
        ])->withInput();
    }

    public function logout(Request $request) {
        foreach (['admin', 'mahasiswa', 'dosen'] as $guard) {
            if (Auth::guard($guard)->check()) {
                Auth::guard($guard)->logout();
                break;
            }
        }
        return redirect('/login');
    }
}
