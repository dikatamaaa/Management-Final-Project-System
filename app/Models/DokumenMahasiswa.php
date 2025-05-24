<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenMahasiswa extends Model
{
    use HasFactory;
    protected $table = 'dokumen_mahasiswa';
    protected $fillable = [
        'nim', 'judul', 'link', 'status'
    ];
} 