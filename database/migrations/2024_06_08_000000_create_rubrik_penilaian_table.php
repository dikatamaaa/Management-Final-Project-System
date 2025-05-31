<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rubrik_penilaian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dosen_id');
            $table->integer('cd'); // CD (Capaian Dasar)
            $table->string('tipe')->default('individu'); // 'individu' atau 'kelompok'
            $table->string('aspek'); // Aspek yang dinilai
            $table->json('indikator')->nullable(); // Indikator per skor (0-4)
            $table->float('bobot')->nullable(); // Bobot individu (opsional)
            $table->integer('urutan')->default(0); // Urutan aspek
            $table->timestamps();

            $table->foreign('dosen_id')->references('id')->on('dosen')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rubrik_penilaian');
    }
}; 