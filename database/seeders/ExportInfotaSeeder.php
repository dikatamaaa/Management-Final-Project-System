<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

// Model yang perlu diimpor
use App\Models\Admin;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\DaftarTopik;

class ExportInfotaSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan direktori penyimpanan ada
        Storage::makeDirectory('exports');

        // Ekspor data ke file JSON
        Storage::put('exports/admin.json', json_encode(Admin::all(), JSON_PRETTY_PRINT));
        Storage::put('exports/mahasiswa.json', json_encode(Mahasiswa::all(), JSON_PRETTY_PRINT));
        Storage::put('exports/dosen.json', json_encode(Dosen::all(), JSON_PRETTY_PRINT));
        Storage::put('exports/daftar_topik.json', json_encode(DaftarTopik::all(), JSON_PRETTY_PRINT));

        $this->command->info("✅ Data berhasil diekspor ke folder storage/app/exports/");
    }
}
