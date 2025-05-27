<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('daftar_topik', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('program_studi');
            $table->string('fakultas');
            $table->string('bidang')->nullable();
            $table->integer('kuota')->nullable();
            $table->string('dosen')->nullable();
            $table->string('kode_dosen')->nullable();
            $table->string('status')->nullable();
            $table->bigInteger('nim')->nullable()->unique();
            $table->string('kelompok')->nullable();
            $table->string('deskripsi')->nullable();
            $table->timestamps();

            $table->foreign('kode_dosen')->references('kode_dosen')->on('dosen');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_topik');
    }
};
