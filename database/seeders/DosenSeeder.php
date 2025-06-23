<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dosen;
use Illuminate\Support\Facades\Hash;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [ 'nip' => '10880005', 'kode_dosen' => 'ANG', 'nama' => 'AGUNG NUGROHO JATI S.T.', 'email' => '10880005@dummy.local', 'no_hp' => null, 'nama_pengguna' => '10880005' ],
            [ 'nip' => '93660027', 'kode_dosen' => 'AGV', 'nama' => 'Ir. AGUS VIRGONO', 'email' => '93660027@dummy.local', 'no_hp' => null, 'nama_pengguna' => '93660027' ],
            [ 'nip' => '14860078', 'kode_dosen' => 'ABO', 'nama' => 'ANDREW BRIAN OSMOND S.T.', 'email' => '14860078@dummy.local', 'no_hp' => null, 'nama_pengguna' => '14860078' ],
            [ 'nip' => '15900014', 'kode_dosen' => 'AGL', 'nama' => 'ANGGUNMEKA LUHUR PRASASTI', 'email' => '15900014@dummy.local', 'no_hp' => null, 'nama_pengguna' => '15900014' ],
            [ 'nip' => '20930008', 'kode_dosen' => 'IHA', 'nama' => 'ASHRI DINIMAHARAWATI', 'email' => '20930008@dummy.local', 'no_hp' => null, 'nama_pengguna' => '20930008' ],
            [ 'nip' => '22800003', 'kode_dosen' => 'WAL', 'nama' => 'Dr. Eng. ASIF AWALUDIN', 'email' => '22800003@dummy.local', 'no_hp' => null, 'nama_pengguna' => '22800003' ],
            [ 'nip' => '10800053', 'kode_dosen' => 'ANY', 'nama' => 'Dr. ASTRI NOVIANTY', 'email' => '10800053@dummy.local', 'no_hp' => null, 'nama_pengguna' => '10800053' ],
            [ 'nip' => '8740064', 'kode_dosen' => 'BIR', 'nama' => 'BUDHI IRAWAN', 'email' => '08740064@dummy.local', 'no_hp' => null, 'nama_pengguna' => '08740064' ],
            [ 'nip' => '93680020', 'kode_dosen' => 'BRH', 'nama' => 'Ir. BURHANUDDIN DIRGANTORO', 'email' => '93680020@dummy.local', 'no_hp' => null, 'nama_pengguna' => '93680020' ],
            [ 'nip' => '19890019', 'kode_dosen' => 'CSI', 'nama' => 'CASI SETIANINGSIH', 'email' => '19890019@dummy.local', 'no_hp' => null, 'nama_pengguna' => '19890019' ],
            [ 'nip' => '19830004', 'kode_dosen' => 'DOI', 'nama' => 'Dipl.-Ing. DICK MARYOPI', 'email' => '19830004@dummy.local', 'no_hp' => null, 'nama_pengguna' => '19830004' ],
            [ 'nip' => '15890008', 'kode_dosen' => 'FZA', 'nama' => 'FAIRUZ AZMI', 'email' => '15890008@dummy.local', 'no_hp' => null, 'nama_pengguna' => '15890008' ],
            [ 'nip' => '20910005', 'kode_dosen' => 'FCB', 'nama' => 'FAISAL CANDRASYAH HASIBUAN', 'email' => '20910005@dummy.local', 'no_hp' => null, 'nama_pengguna' => '20910005' ],
            [ 'nip' => '20950005', 'kode_dosen' => 'FUY', 'nama' => 'FUSSY MENTARI DIRGANTARA', 'email' => '20950005@dummy.local', 'no_hp' => null, 'nama_pengguna' => '20950005' ],
            [ 'nip' => '22850001', 'kode_dosen' => 'IZK', 'nama' => 'IZAZI MUBAROK', 'email' => '22850001@dummy.local', 'no_hp' => null, 'nama_pengguna' => '22850001' ],
            [ 'nip' => '13750017', 'kode_dosen' => 'MPY', 'nama' => 'Dr. MARISA W. PARYASTO', 'email' => '13750017@dummy.local', 'no_hp' => null, 'nama_pengguna' => '13750017' ],
            [ 'nip' => '18890135', 'kode_dosen' => 'MKT', 'nama' => 'Dr. META KALLISTA', 'email' => '18890135@dummy.local', 'no_hp' => null, 'nama_pengguna' => '18890135' ],
            [ 'nip' => '20920031', 'kode_dosen' => 'FRW', 'nama' => 'MUHAMMAD FARIS RURIAWAN', 'email' => '20920031@dummy.local', 'no_hp' => null, 'nama_pengguna' => '20920031' ],
            [ 'nip' => '10750046', 'kode_dosen' => 'MNR', 'nama' => 'MUHAMMAD NASRUN', 'email' => '10750046@dummy.local', 'no_hp' => null, 'nama_pengguna' => '10750046' ],
            [ 'nip' => '20840004', 'kode_dosen' => 'PYO', 'nama' => 'Dr. Eng. PRAYITNO ABADI', 'email' => '20840004@dummy.local', 'no_hp' => null, 'nama_pengguna' => '20840004' ],
            [ 'nip' => '10800047', 'kode_dosen' => 'PBD', 'nama' => 'Dr. PURBA DARU KUSUMA', 'email' => '10800047@dummy.local', 'no_hp' => null, 'nama_pengguna' => '10800047' ],
            [ 'nip' => '15870030', 'kode_dosen' => 'RES', 'nama' => 'RANDY ERFA SAPUTRA', 'email' => '15870030@dummy.local', 'no_hp' => null, 'nama_pengguna' => '15870030' ],
            [ 'nip' => '23910015', 'kode_dosen' => 'RER', 'nama' => 'Dr. REZA RENDIAN SEPTIAWAN', 'email' => '23910015@dummy.local', 'no_hp' => null, 'nama_pengguna' => '23910015' ],
            [ 'nip' => '23960018', 'kode_dosen' => 'IFQ', 'nama' => 'RIFQI MUHAMMAD FIKRI', 'email' => '23960018@dummy.local', 'no_hp' => null, 'nama_pengguna' => '23960018' ],
            [ 'nip' => '14780013', 'kode_dosen' => 'RLC', 'nama' => 'ROSWAN LATUCONSINA', 'email' => '14780013@dummy.local', 'no_hp' => null, 'nama_pengguna' => '14780013' ],
            [ 'nip' => '13860021', 'kode_dosen' => 'SMC', 'nama' => 'Dr. SURYA MICHRANDI NASUTION', 'email' => '13860021@dummy.local', 'no_hp' => null, 'nama_pengguna' => '13860021' ],
            [ 'nip' => '11850763', 'kode_dosen' => 'UAA', 'nama' => 'UMAR ALI AHMAD', 'email' => '11850763@dummy.local', 'no_hp' => null, 'nama_pengguna' => '11850763' ],
            [ 'nip' => '20790002', 'kode_dosen' => 'WEJ', 'nama' => 'Dr. Eng. WENDI HARJUPA', 'email' => '20790002@dummy.local', 'no_hp' => null, 'nama_pengguna' => '20790002' ],
            [ 'nip' => '21850001', 'kode_dosen' => 'WPT', 'nama' => 'Dr. Eng. WILDAN PANJI TRESNA', 'email' => '21850001@dummy.local', 'no_hp' => null, 'nama_pengguna' => '21850001' ],
            [ 'nip' => '2770066', 'kode_dosen' => 'YDP', 'nama' => 'Dr. YUDHA PURWANTO', 'email' => '02770066@dummy.local', 'no_hp' => null, 'nama_pengguna' => '02770066' ],
        ];

        foreach ($data as $dosen) {
            $dosen['kata_sandi'] = Hash::make($dosen['nip']);
            Dosen::updateOrCreate(['nip' => $dosen['nip']], $dosen);
        }
    }
}
