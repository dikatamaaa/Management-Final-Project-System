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
        Schema::table('kelompok', function (Blueprint $table) {
            $table->string('status_pembimbing_dua')->default('pending');
            $table->string('alasan_tolak_pembimbing_dua')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kelompok', function (Blueprint $table) {
            $table->dropColumn('status_pembimbing_dua');
            $table->dropColumn('alasan_tolak_pembimbing_dua');
        });
    }
};
