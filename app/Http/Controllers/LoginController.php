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
/**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // 1. Tambahkan validasi untuk 'role' untuk memastikan data yang dikirim valid
        $request->validate([
            'nama_pengguna' => 'required|string',
            'kata_sandi' => 'required|string|min:8',
            'role' => 'required|in:Admin,Mahasiswa,Dosen', // Pastikan role ada dan sesuai
        ], [
            'nama_pengguna.required' => 'Nama Pengguna Wajib Diisi!.',
            'kata_sandi.required' => 'Kata Sandi Wajib Diisi!.',
            'kata_sandi.min' => 'Kata Sandi Minimal 8 Karakter',
        ]);

        // 2. Ambil kredensial dan (role) dari request
        $nama_pengguna = $request->input('nama_pengguna');
        $kata_sandi = $request->input('kata_sandi');
        $role = $request->input('role');

        // 3. 'switch' untuk memisahkan logika berdasarkan peran yang dipilih
        switch ($role) {
            case 'Admin':
                $admin = Admin::where('nama_pengguna', $nama_pengguna)->first();
                // Cek jika admin ada dan password cocok
                if ($admin && Hash::check($kata_sandi, $admin->kata_sandi)) {
                    Auth::guard('admin')->login($admin);
                    $request->session()->regenerate();
                    return redirect()->intended('/admin/beranda');
                }
                break; // Keluar dari switch jika login admin gagal

            case 'Mahasiswa':
                $mahasiswa = Mahasiswa::where('nama_pengguna', $nama_pengguna)->first();
                // Cek jika mahasiswa ada dan password cocok
                if ($mahasiswa && Hash::check($kata_sandi, $mahasiswa->kata_sandi)) {
                    Auth::guard('mahasiswa')->login($mahasiswa);
                    $request->session()->regenerate();
                    // Cek jika mahasiswa wajib ganti password
                    if ($mahasiswa->wajib_ganti_password) {
                        return redirect('/mahasiswa/ganti-password-awal');
                    }
                    return redirect()->intended('/mahasiswa/beranda');
                }
                break; // Keluar dari switch jika login mahasiswa gagal

            case 'Dosen':
                $dosen = Dosen::where('nama_pengguna', $nama_pengguna)->first();
                // Cek jika dosen ada dan password cocok
                if ($dosen && Hash::check($kata_sandi, $dosen->kata_sandi)) {
                    Auth::guard('dosen')->login($dosen);
                    $request->session()->regenerate();
                    return redirect()->intended('/dosen/beranda');
                }
                break; // Keluar dari switch jika login dosen gagal
        }

        // 4. Pesan error jika login gagal SETELAH dicek sesuai peran
        // Kode ini hanya akan berjalan jika tidak ada satupun 'return redirect()' di dalam switch yang berhasil dieksekusi.
        return back()->withErrors([
            'login' => 'Nama Pengguna atau Kata Sandi Salah! Pastikan Anda memilih peran yang benar.',
        ])->withInput($request->only('nama_pengguna', 'role')); // Kembalikan input nama_pengguna dan role
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        foreach (['admin', 'mahasiswa', 'dosen'] as $guard) {
            if (Auth::guard($guard)->check()) {
                Auth::guard($guard)->logout();
                break;
            }
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
