<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Rencana;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KelasJurusanRencanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kelas
        $kelasList = ['X', 'XI', 'XII', 'XIII'];
        foreach ($kelasList as $nama) {
            Kelas::create(['nama_kelas' => $nama]);
        }

        // Jurusan
        $jurusanList = ['TKR', 'SIJA', 'TAV', 'TITL', 'TP', 'DPIB', 'KGSP', 'DKV', 'GEO'];
        foreach ($jurusanList as $nama) {
            Jurusan::create(['nama_jurusan' => $nama]);
        }

        // Rencana
        $rencanaList = ['Kuliah', 'Kerja'];
        foreach ($rencanaList as $nama) {
            Rencana::create(['nama_rencana' => $nama]);
        }
    }
}
