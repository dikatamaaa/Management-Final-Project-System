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
        Schema::create('jadwal_sidang', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->dateTime('tanggal_sidang');
            $table->string('ruangan');
            $table->unsignedBigInteger('penguji_1');
            $table->unsignedBigInteger('penguji_2');
            $table->enum('jenis_sidang', ['Proposal', 'Progress', 'Final']);
            $table->enum('status', ['Scheduled', 'Completed', 'Postponed'])->default('Scheduled');
            $table->text('catatan')->nullable();
            $table->unsignedBigInteger('kelompok_id');
            $table->timestamps();

            // Foreign keys
            $table->foreign('penguji_1')->references('id')->on('dosen');
            $table->foreign('penguji_2')->references('id')->on('dosen');
            $table->foreign('kelompok_id')->references('id')->on('kelompok');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_sidang');
    }
}; 