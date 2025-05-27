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
} 