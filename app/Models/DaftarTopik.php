<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarTopik extends Model
{
    use HasFactory;
    protected $table = 'daftar_topik';
    protected $fillable = ['judul','program_studi','fakultas','bidang','kuota','dosen','kode_dosen','status','nim','kelompok','deskripsi'];
    protected $casts = [
        'bidang' => 'array',
        'nim' => 'array',
        'kelompok' => 'array',
    ];
}
