<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Dosen extends Authenticatable
{
    protected $table = 'dosen';
    protected $fillable = ['foto', 'nip', 'kode_dosen','nama','email','no_hp','nama_pengguna','kata_sandi','role'];
    protected $hidden = ['kata_sandi'];

    public function getAuthPassword() {
        return $this->kata_sandi;
    }
}
