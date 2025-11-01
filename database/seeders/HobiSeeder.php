<?php

namespace Database\Seeders;

use App\Models\Hobi;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HobiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hobiList = [
            ['nama_hobi' => 'Rekayasa Mesin'],
            ['nama_hobi' => 'Servis Kendaraan'],
            ['nama_hobi' => 'Analisis Produksi'],
            ['nama_hobi' => 'Pemrograman'],
            ['nama_hobi' => 'Analisis Data'],
            ['nama_hobi' => 'Jaringan Komputer'],
            ['nama_hobi' => 'Elektronika'],
            ['nama_hobi' => 'Sinematografi'],
            ['nama_hobi' => 'Fotografi'],
            ['nama_hobi' => 'Kelistrikan'],
            ['nama_hobi' => 'Komunikasi Data'],
            ['nama_hobi' => 'Perakitan Komputer'],
            ['nama_hobi' => 'Desain Grafis'],
            ['nama_hobi' => 'Desain Digital'],
            ['nama_hobi' => 'Inovasi Produk'],
            ['nama_hobi' => 'Desain Bangunan'],
            ['nama_hobi' => 'Tata Ruang'],
            ['nama_hobi' => 'Manajemen Proyek'],
            ['nama_hobi' => 'Pengawasan Proyek'],
            ['nama_hobi' => 'Rancang Struktur'],
            ['nama_hobi' => 'Konstruksi Bangunan'],
            ['nama_hobi' => 'Desain Mekanik'],
            ['nama_hobi' => 'Optimasi Proses'],
            ['nama_hobi' => 'Rakit Mesin'],
            ['nama_hobi' => 'Pemetaan Wilayah'],
            ['nama_hobi' => 'Eksplorasi Alam'],
            ['nama_hobi' => 'Survei Lahan'],
        ];
        foreach ($hobiList as $hobi) {
            Hobi::create($hobi);
        }
    }
}
