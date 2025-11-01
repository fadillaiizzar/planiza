<?php

namespace Database\Seeders;

use App\Models\Kampus;
use App\Models\JurusanKuliah;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KampusJurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kampusJurusanMap = [
            'Universitas Gadjah Mada' => [
                ['jurusan' => 'Teknik Mesin Otomotif', 'passing_grade' => 690],
                ['jurusan' => 'Teknik Industri', 'passing_grade' => 700],
                ['jurusan' => 'Teknik Informatika', 'passing_grade' => 725],
                ['jurusan' => 'Teknologi Rekayasa Konstruksi', 'passing_grade' => 599],
                ['jurusan' => 'Arsitektur', 'passing_grade' => 705],
                ['jurusan' => 'Teknik Geodesi', 'passing_grade' => 700],
                ['jurusan' => 'Desain Produk', 'passing_grade' => 695],
            ],

            'Institut Teknologi Sepuluh Nopember' => [
                ['jurusan' => 'Teknik Mesin Manufaktur', 'passing_grade' => 685],
                ['jurusan' => 'Teknik Elektro', 'passing_grade' => 695],
                ['jurusan' => 'Teknik Komputer', 'passing_grade' => 700],
                ['jurusan' => 'Teknik Industri', 'passing_grade' => 690],
                ['jurusan' => 'Teknologi Informasi', 'passing_grade' => 675],
                ['jurusan' => 'Desain Produk', 'passing_grade' => 665],
                ['jurusan' => 'Teknologi Rekayasa Konstruksi', 'passing_grade' => 441],
            ],

            'Universitas Indonesia' => [
                ['jurusan' => 'Teknik Mesin Manufaktur', 'passing_grade' => 700],
                ['jurusan' => 'Sistem Informasi', 'passing_grade' => 720],
                ['jurusan' => 'Arsitektur', 'passing_grade' => 705],
                ['jurusan' => 'Desain Komunikasi Visual', 'passing_grade' => 710],
                ['jurusan' => 'Teknik Industri', 'passing_grade' => 715],
                ['jurusan' => 'Teknik Elektro', 'passing_grade' => 705],
                ['jurusan' => 'Teknik Sipil', 'passing_grade' => 710],
            ],

            'Universitas Brawijaya' => [
                ['jurusan' => 'Teknik Mesin Manufaktur', 'passing_grade' => 670],
                ['jurusan' => 'Teknik Informatika', 'passing_grade' => 690],
                ['jurusan' => 'Teknik Sipil', 'passing_grade' => 675],
                ['jurusan' => 'Teknik Industri', 'passing_grade' => 680],
                ['jurusan' => 'Desain Komunikasi Visual', 'passing_grade' => 660],
                ['jurusan' => 'Arsitektur', 'passing_grade' => 670],
            ],

            'Telkom University' => [
                ['jurusan' => 'Teknik Informatika', 'passing_grade' => 690],
                ['jurusan' => 'Sistem Informasi', 'passing_grade' => 685],
                ['jurusan' => 'Teknologi Informasi', 'passing_grade' => 670],
                ['jurusan' => 'Desain Komunikasi Visual', 'passing_grade' => 660],
                ['jurusan' => 'Animasi', 'passing_grade' => 650],
            ],

            'Universitas Negeri Yogyakarta' => [
                ['jurusan' => 'Teknik Otomotif', 'passing_grade' => 640],
                ['jurusan' => 'Teknik Elektro', 'passing_grade' => 660],
                ['jurusan' => 'Teknik Komputer', 'passing_grade' => 650],
                ['jurusan' => 'Teknik Sipil', 'passing_grade' => 655],
                ['jurusan' => 'Teknik Elektro Otomotif', 'passing_grade' => 589],
            ],

            'Politeknik Negeri Bandung' => [
                ['jurusan' => 'Teknik Mesin Otomotif', 'passing_grade' => 640],
                ['jurusan' => 'Teknik Otomotif', 'passing_grade' => 630],
                ['jurusan' => 'Teknik Manufaktur', 'passing_grade' => 625],
                ['jurusan' => 'Teknik Elektro Otomotif', 'passing_grade' => 563],
            ],

            'Universitas Diponegoro' => [
                ['jurusan' => 'Arsitektur', 'passing_grade' => 670],
                ['jurusan' => 'Teknik Sipil', 'passing_grade' => 675],
                ['jurusan' => 'Teknik Geodesi', 'passing_grade' => 665],
                ['jurusan' => 'Teknik Industri', 'passing_grade' => 670],
            ],

            'Institut Seni Indonesia Yogyakarta' => [
                ['jurusan' => 'Desain Komunikasi Visual', 'passing_grade' => 640],
                ['jurusan' => 'Animasi', 'passing_grade' => 630],
                ['jurusan' => 'Film dan Televisi', 'passing_grade' => 620],
                ['jurusan' => 'Seni Media Rekam', 'passing_grade' => 615],
            ],

            'Universitas Atma Jaya Yogyakarta' => [
                ['jurusan' => 'Arsitektur', 'passing_grade' => 660],
                ['jurusan' => 'Desain Interior', 'passing_grade' => 645],
            ],

            'Universitas Muhammadiyah Yogyakarta' => [
                ['jurusan' => 'Teknik Informatika', 'passing_grade' => 665],
                ['jurusan' => 'Sistem Informasi', 'passing_grade' => 660],
                ['jurusan' => 'Teknik Elektro', 'passing_grade' => 650],
            ],

            'Universitas Kristen Petra' => [
                ['jurusan' => 'Desain Komunikasi Visual', 'passing_grade' => 650],
                ['jurusan' => 'Desain Produk', 'passing_grade' => 640],
                ['jurusan' => 'Arsitektur', 'passing_grade' => 645],
                ['jurusan' => 'Manajemen Konstruksi', 'passing_grade' => 635],
            ],

            'Politeknik Negeri Semarang' => [
                ['jurusan' => 'Manajemen Konstruksi', 'passing_grade' => 630],
                ['jurusan' => 'Teknik Bangunan Gedung', 'passing_grade' => 625],
            ],

            'Universitas Negeri Malang' => [
                ['jurusan' => 'Teknik Mesin Otomotif', 'passing_grade' => 650],
                ['jurusan' => 'Teknik Elektro', 'passing_grade' => 645],
                ['jurusan' => 'Desain Produk', 'passing_grade' => 635],
                ['jurusan' => 'Teknik Otomotif', 'passing_grade' => 640],
            ],

            'Institut Teknologi Nasional Malang' => [
                ['jurusan' => 'Teknik Mesin Manufaktur', 'passing_grade' => 650],
                ['jurusan' => 'Arsitektur', 'passing_grade' => 640],
            ],

            'Universitas Negeri Jakarta' => [
                ['jurusan' => 'Teknologi Rekayasa Konstruksi', 'passing_grade' => 582],
            ],

            'Politeknik Negeri Jakarta' => [
                ['jurusan' => 'Teknik Elektro Otomotif', 'passing_grade' => 638],
            ],
        ];
        $allJurusan = JurusanKuliah::pluck('id', 'nama_jurusan_kuliah')->toArray();
        foreach ($kampusJurusanMap as $kampusName => $jurusanList) {
            $kampus = Kampus::where('nama_kampus', $kampusName)->first();
            if (!$kampus) continue;

            $attachData = [];
            foreach ($jurusanList as $data) {
                if (isset($allJurusan[$data['jurusan']])) {
                    $attachData[$allJurusan[$data['jurusan']]] = ['passing_grade' => $data['passing_grade']];
                }
            }

            if (!empty($attachData)) {
                $kampus->jurusanKuliahs()->syncWithoutDetaching($attachData);
            }
        }
    }
}
