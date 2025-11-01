<?php

namespace Database\Seeders;

use App\Models\KategoriMinat;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriMinatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $riasecList = [
            ['nama_kategori' => 'Realistic', 'deskripsi' => 'Praktis, suka bekerja dengan alat atau mesin'],
            ['nama_kategori' => 'Investigative', 'deskripsi' => 'Analitis, suka penelitian dan problem solving'],
            ['nama_kategori' => 'Artistic', 'deskripsi' => 'Kreatif, suka seni dan ekspresi diri'],
            ['nama_kategori' => 'Social', 'deskripsi' => 'Suka membantu orang lain dan berinteraksi sosial'],
            ['nama_kategori' => 'Enterprising', 'deskripsi' => 'Suka memimpin, berwirausaha, dan mengambil risiko'],
            ['nama_kategori' => 'Conventional', 'deskripsi' => 'Suka keteraturan, administrasi, dan struktur kerja'],
        ];
        foreach ($riasecList as $kategori) {
            KategoriMinat::create($kategori);
        }
    }
}
