<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Mahasiswa extends Authenticatable
{
    use Notifiable;

    protected $table = 'mahasiswa';
    protected $fillable = ['foto','nim','nama','kelas','program_studi','fakultas','angkatan','email','no_hp','nama_pengguna', 'kata_sandi', 'role', 'wajib_ganti_password'];
    protected $hidden = ['kata_sandi'];

    public function getAuthPassword() {
        return $this->kata_sandi;
    }
}
