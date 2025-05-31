<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('penilaian_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('nim')->nullable();
            $table->string('kelompok_judul');
            $table->enum('pembimbing', ['1','2']);
            $table->integer('nilai');
            $table->string('dosen_nama');
            $table->unsignedBigInteger('rubrik_id')->nullable();
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('penilaian_mahasiswa');
    }
}; 