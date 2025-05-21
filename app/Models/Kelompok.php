<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    use HasFactory;
    protected $table = 'kelompok';
    protected $fillable = ['judul','nim','nama_anggota','pembimbing_satu','pembimbing_dua','nilai'];
    protected $casts = [
        'nim' => 'array',
        'nama_anggota' => 'array',
    ];
}
