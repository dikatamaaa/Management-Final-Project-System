<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('penilaian_mahasiswa', function (Blueprint $table) {
            $table->string('nim')->nullable()->change();
        });
    }
    public function down() {
        Schema::table('penilaian_mahasiswa', function (Blueprint $table) {
            $table->string('nim')->nullable(false)->change();
        });
    }
}; 