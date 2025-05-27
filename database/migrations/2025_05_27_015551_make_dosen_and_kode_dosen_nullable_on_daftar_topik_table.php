<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeDosenAndKodeDosenNullableOnDaftarTopikTable extends Migration
{
    public function up()
    {
        Schema::table('daftar_topik', function (Blueprint $table) {
            $table->string('dosen')->nullable()->change();
            $table->string('kode_dosen')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('daftar_topik', function (Blueprint $table) {
            $table->string('dosen')->nullable(false)->change();
            $table->string('kode_dosen')->nullable(false)->change();
        });
    }
}