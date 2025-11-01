<?php

namespace Database\Seeders;

use App\Models\Hobi;
use App\Models\JurusanKuliah;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HobiJurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hobiJurusanMap = [
            'Rekayasa Mesin' => [['jurusan' => 'Teknik Mesin Otomotif', 'poin' => 20]],
            'Servis Kendaraan' => [['jurusan' => 'Teknik Otomotif', 'poin' => 20]],
            'Analisis Produksi' => [['jurusan' => 'Teknik Elektro Otomotif', 'poin' => 20]],
            'Pemrograman' => [['jurusan' => 'Teknik Informatika', 'poin' => 20]],
            'Analisis Data' => [['jurusan' => 'Sistem Informasi', 'poin' => 20]],
            'Jaringan Komputer' => [['jurusan' => 'Teknologi Informasi', 'poin' => 20]],
            'Elektronika' => [['jurusan' => 'Teknik Audio Video', 'poin' => 20]],
            'Sinematografi' => [['jurusan' => 'Film dan Televisi', 'poin' => 20]],
            'Fotografi' => [['jurusan' => 'Seni Media Rekam', 'poin' => 20]],
            'Kelistrikan' => [['jurusan' => 'Teknik Elektro', 'poin' => 20]],
            'Komunikasi Data' => [['jurusan' => 'Teknik Telekomunikasi', 'poin' => 20]],
            'Perakitan Komputer' => [['jurusan' => 'Teknik Komputer', 'poin' => 20]],
            'Desain Grafis' => [['jurusan' => 'Desain Komunikasi Visual', 'poin' => 20]],
            'Desain Digital' => [['jurusan' => 'Animasi', 'poin' => 20]],
            'Inovasi Produk' => [['jurusan' => 'Desain Produk', 'poin' => 20]],
            'Desain Bangunan' => [['jurusan' => 'Arsitektur', 'poin' => 20]],
            'Tata Ruang' => [['jurusan' => 'Desain Interior', 'poin' => 20]],
            'Manajemen Proyek' => [['jurusan' => 'Teknologi Rekayasa Konstruksi', 'poin' => 20]],
            'Pengawasan Proyek' => [['jurusan' => 'Manajemen Konstruksi', 'poin' => 20]],
            'Rancang Struktur' => [['jurusan' => 'Teknik Bangunan Gedung', 'poin' => 20]],
            'Konstruksi Bangunan' => [['jurusan' => 'Teknik Sipil', 'poin' => 20]],
            'Desain Mekanik' => [['jurusan' => 'Teknik Mesin Manufaktur', 'poin' => 20]],
            'Optimasi Proses' => [['jurusan' => 'Teknik Industri', 'poin' => 20]],
            'Rakit Mesin' => [['jurusan' => 'Teknik Manufaktur', 'poin' => 20]],
            'Pemetaan Wilayah' => [['jurusan' => 'Teknik Geodesi', 'poin' => 20]],
            'Eksplorasi Alam' => [['jurusan' => 'Geografi', 'poin' => 20]],
            'Survei Lahan' => [['jurusan' => 'Teknologi Survei dan Pemetaan', 'poin' => 20]],
        ];
        $allJurusan = JurusanKuliah::pluck('id', 'nama_jurusan_kuliah')->toArray();
        foreach ($hobiJurusanMap as $hobiName => $jurusanList) {
            $hobi = Hobi::where('nama_hobi', $hobiName)->first();
            if (!$hobi) continue; // skip kalau hobi belum ada di tabel

            $attachData = [];

            foreach ($jurusanList as $data) {
                if (isset($allJurusan[$data['jurusan']])) {
                    $attachData[$allJurusan[$data['jurusan']]] = ['poin' => $data['poin']];
                }
            }

            if (!empty($attachData)) {
                $hobi->jurusanKuliahs()->syncWithoutDetaching($attachData);
            }
        }
    }
}
