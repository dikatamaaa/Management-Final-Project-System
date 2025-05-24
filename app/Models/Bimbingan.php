<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bimbingan extends Model
{
    use HasFactory;
    protected $table = 'bimbingan';
    protected $fillable = [
        'nim', 'judul', 'pembimbing', 'jadwal', 'status', 'catatan', 'kritik_saran', 'alasan_tolak'
    ];
} 