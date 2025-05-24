<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('kelompok', function (Blueprint $table) {
            $table->string('status_pembimbing_dua')->nullable()->change();
        });
    }
    public function down() {
        Schema::table('kelompok', function (Blueprint $table) {
            $table->string('status_pembimbing_dua')->nullable(false)->change();
        });
    }
}; 