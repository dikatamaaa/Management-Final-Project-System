<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianMahasiswa extends Model
{
    use HasFactory;
    protected $table = 'penilaian_mahasiswa';
    protected $fillable = [
        'nim', 'kelompok_judul', 'pembimbing', 'nilai', 'catatan', 'dosen_nama'
    ];
} 