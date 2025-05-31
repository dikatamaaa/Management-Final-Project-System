<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RubrikPenilaian extends Model
{
    use HasFactory;
    protected $table = 'rubrik_penilaian';
    protected $fillable = [
        'dosen_id', 'cd', 'aspek', 'indikator', 'bobot', 'urutan', 'tipe'
    ];
    protected $casts = [
        'indikator' => 'array',
    ];
    // Relasi ke dosen
    public function dosen() {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }
} 