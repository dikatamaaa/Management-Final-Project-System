<?php

namespace App\Http\Controllers;

use App\Models\Kelompok;
use App\Models\Mahasiswa;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class MahasiswaController extends Controller
{
    /**
     * Menampilkan Form Data Kelompok Yang Sudah Ada
     */
    public function dataMahasiswa() : View {
        $prodi = auth()->guard('mahasiswa')->user()->program_studi;
        $dataMahasiswa = Mahasiswa::where('program_studi', $prodi)->get();
        return view('mahasiswa.kelompok', compact('dataMahasiswa'));
    }
}
