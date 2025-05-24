<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up() {
        DB::table('kelompok')
            ->whereNull('pembimbing_dua')
            ->where('status_pembimbing_dua', 'pending')
            ->update(['status_pembimbing_dua' => null]);
    }
    public function down() {
        // Tidak perlu rollback
    }
}; 