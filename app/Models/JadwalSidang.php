<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalSidang extends Model
{
    use HasFactory;

    protected $table = 'jadwal_sidang';
    protected $guarded = ['id'];

    protected $casts = [
        'tanggal_sidang' => 'datetime',
    ];

    // Relasi ke kelompok
    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class, 'kelompok_id');
    }

    // Relasi ke dosen penguji
    public function dosenPenguji1()
    {
        return $this->belongsTo(Dosen::class, 'penguji_1');
    }

    public function dosenPenguji2()
    {
        return $this->belongsTo(Dosen::class, 'penguji_2');
    }
} 