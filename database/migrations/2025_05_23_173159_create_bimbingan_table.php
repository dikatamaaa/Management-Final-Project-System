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
        Schema::create('bimbingan', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('judul');
            $table->enum('pembimbing', ['1', '2']);
            $table->dateTime('jadwal');
            $table->enum('status', ['pending', 'accepted', 'rejected', 'selesai'])->default('pending');
            $table->text('catatan')->nullable();
            $table->text('kritik_saran')->nullable();
            $table->text('alasan_tolak')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bimbingan');
    }
};
