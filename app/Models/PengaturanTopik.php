<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanTopik extends Model
{
    protected $table = 'pengaturan_topik';
    protected $guarded = [];
    protected $casts = [
        'list_bidang' => 'array',
    ];
    
    protected static function booted()
    {
        static::updated(function ($pengaturan) {
            // Jika kuota maksimal diubah, semua topik ikut kuota_max terbaru
            if ($pengaturan->isDirty('kuota_max')) {
                \App\Models\DaftarTopik::query()->update(['kuota' => $pengaturan->kuota_max]);
            }
        });
    }
} 
