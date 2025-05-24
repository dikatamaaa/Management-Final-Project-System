<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('penilaian_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('kelompok_judul');
            $table->enum('pembimbing', ['1','2']);
            $table->integer('nilai');
            $table->string('catatan')->nullable();
            $table->string('dosen_nama');
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('penilaian_mahasiswa');
    }
}; 