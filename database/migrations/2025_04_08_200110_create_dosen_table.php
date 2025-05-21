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
        Schema::create('dosen', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->nullable();
            $table->bigInteger('nip')->unique();
            $table->string('kode_dosen')->unique();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('no_hp')->nullable()->unique();
            $table->string('nama_pengguna')->unique();
            $table->string('kata_sandi');
            $table->string('role')->default('dosen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen');
    }
};
