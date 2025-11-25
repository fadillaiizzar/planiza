<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HubunganSdgs;
use App\Models\ProfesiKerja;
use App\Models\KategoriSdgs;
use App\Models\JurusanKuliah;

class HubunganSdgsSeeder extends Seeder
{
    public function run()
    {
        // ============================
        // 1. Data PROFESI → SDGs
        // ============================
        $profesiData = [
            // TKR
            'Teknisi Otomotif' => [8, 9, 12],
            'Operator Mesin Industri' => [8, 9, 12],
            'Teknisi Listrik Otomotif' => [7, 8, 9],
            'Mekanik Motor' => [8, 12],
            'Teknisi Kendaraan Berat' => [8, 9],
            'Teknisi Diagnosa Mesin' => [8, 9],

            // SIJA
            'Programmer' => [4, 8, 9, 17],
            'Web Developer' => [4, 8, 9, 17],
            'Network Engineer' => [9, 11, 17],
            'System Analyst' => [4, 8, 9],
            'Database Administrator' => [9, 16, 17],
            'Cybersecurity Analyst' => [9, 16],

            // TAV
            'Teknisi Audio Visual' => [4, 8, 9],
            'Video Editor' => [4, 8],
            'Video Motion Specialist' => [4, 8],
            'Sound Designer' => [4, 8],
            'Motion Graphics Designer' => [4, 8],
            'Broadcast Technician' => [4, 8, 9],

            // TITL
            'Teknisi Telekomunikasi' => [7, 9, 11],
            'Teknisi Fiber Optik' => [9, 11],
            'Operator BTS' => [9, 11, 16],
            'Network Installer' => [9, 11],
            'Telecom Technician' => [9, 11],
            'Satellite Technician' => [9, 11, 17],

            // TP
            'Operator Mesin Bubut' => [8, 9, 12],
            'Operator Mesin CNC' => [8, 9, 12],
            'Teknisi Produksi Manufaktur' => [8, 9, 12],
            'Teknisi Perawatan Mesin Industri' => [8, 9],
            'Quality Control Produk Mekanik' => [8, 9, 12],
            'Drafter Mesin' => [8, 9, 12],

            // DPIB
            'Desainer Interior' => [8, 11, 12],
            'Arsitek' => [9, 11, 12, 13],
            'Desainer Furniture' => [8, 12],
            'Project Architect' => [9, 11, 13, 17],
            '3D Visualizer' => [8, 11],
            'Desainer Retail' => [8, 12],

            // KGSP
            'Manajer Fasilitas Gedung' => [9, 11, 12, 13],
            'Teknisi Pemeliharaan Bangunan' => [9, 11, 12],
            'Supervisor Konstruksi Gedung' => [8, 9, 11, 13],
            'Ahli Sanitasi Bangunan' => [6, 11, 12],
            'Teknisi Instalasi Gedung' => [7, 9, 11],
            'Estimator Konstruksi' => [8, 9, 11],

            // DKV
            'Desainer Grafis' => [4, 8, 12],
            'Ilustrator' => [4, 8],
            'Animator' => [4, 8],
            'Motion Designer' => [4, 8],
            'Visual Storyteller' => [4, 8],
            'Art Director' => [4, 8, 12, 17],

            // GEO
            'Surveyor' => [9, 11, 13, 15],
            'Geomatik' => [9, 11, 15, 17],
            'Teknisi Pemetaan' => [9, 11, 15],
            'Cartographer' => [4, 9, 15],
            'Remote Sensing Analyst' => [13, 14, 15],
            'Ahli Sistem Informasi Geografis' => [9, 11, 13, 15, 17],
        ];

        // ============================
        // 2. Data JURUSAN → SDGs
        // ============================
        $jurusanData = [
            // TKR
            'Teknik Mesin Otomotif' => [8, 9, 12, 13],
            'Teknik Otomotif' => [8, 9, 12],
            'Teknik Elektro Otomotif' => [7, 8, 9, 12],

            // SIJA
            'Teknik Informatika' => [4, 8, 9, 11, 16, 17],
            'Sistem Informasi' => [4, 8, 9, 16, 17],
            'Teknologi Informasi' => [4, 8, 9, 11, 13, 17],

            // TAV
            'Teknik Audio Video' => [4, 8, 9, 11],
            'Film dan Televisi' => [4, 8, 11, 12],
            'Seni Media Rekam' => [4, 8, 12],

            // TITL
            'Teknik Elektro' => [7, 9, 11, 12],
            'Teknik Telekomunikasi' => [7, 9, 11, 16, 17],
            'Teknik Komputer' => [4, 8, 9, 11, 16, 17],

            // DKV
            'Desain Komunikasi Visual' => [4, 8, 12, 17],
            'Animasi' => [4, 8, 11, 12],
            'Desain Produk' => [8, 9, 12, 13],

            // DPIB
            'Arsitektur' => [9, 11, 12, 13],
            'Desain Interior' => [8, 11, 12],
            'Teknologi Rekayasa Konstruksi' => [9, 11, 12, 13],

            // KGSP
            'Manajemen Konstruksi' => [8, 9, 11, 12, 13, 17],
            'Teknik Bangunan Gedung' => [9, 11, 12, 13],
            'Teknik Sipil' => [9, 11, 12, 13, 15],

            // TP
            'Teknik Mesin Manufaktur' => [8, 9, 12],
            'Teknik Industri' => [8, 9, 12, 13],
            'Teknik Manufaktur' => [8, 9, 12],

            // GEO
            'Teknik Geodesi' => [9, 11, 13, 15, 17],
            'Geografi' => [4, 11, 13, 14, 15],
            'Teknologi Survei dan Pemetaan' => [9, 11, 13, 15, 17],
        ];

        // ============================
        // MERGING PROFESI & JURUSAN
        // ============================

        foreach ($jurusanData as $jurusanName => $sdgsList) {

            $jurusan = JurusanKuliah::where('nama_jurusan_kuliah', $jurusanName)->first();

            if (!$jurusan) {
                echo "Jurusan tidak ditemukan: $jurusanName\n";
                continue;
            }

            foreach ($sdgsList as $nomor) {

                $kategori = KategoriSdgs::where('nomor_kategori', $nomor)->first();
                if (!$kategori) continue;

                /**
                 * Cek apakah sudah ada baris hubungan SDGs dari profesi
                 * dengan kategori yg sama.
                 */
                $existing = HubunganSdgs::where('kategori_sdgs_id', $kategori->id)
                    ->whereNull('jurusan_kuliah_id')
                    ->first();

                if ($existing) {
                    // merge
                    $existing->update([
                        'jurusan_kuliah_id' => $jurusan->id
                    ]);
                } else {
                    // buat baru
                    HubunganSdgs::create([
                        'kategori_sdgs_id' => $kategori->id,
                        'profesi_kerja_id' => null,
                        'jurusan_kuliah_id' => $jurusan->id,
                    ]);
                }
            }
        }

        // ============================
        // INSERT PROFESI (TIDAK DIHAPUS)
        // ============================

        foreach ($profesiData as $profesiName => $sdgsList) {

            $profesi = ProfesiKerja::where('nama_profesi_kerja', $profesiName)->first();
            if (!$profesi) continue;

            foreach ($sdgsList as $nomor) {

                $kategori = KategoriSdgs::where('nomor_kategori', $nomor)->first();
                if (!$kategori) continue;

                /**
                 * Jika sudah ada baris (karena jurusan), tinggal isi profesinya.
                 */
                $existing = HubunganSdgs::where('kategori_sdgs_id', $kategori->id)
                    ->whereNull('profesi_kerja_id')
                    ->first();

                if ($existing) {
                    $existing->update([
                        'profesi_kerja_id' => $profesi->id
                    ]);
                } else {
                    HubunganSdgs::create([
                        'kategori_sdgs_id' => $kategori->id,
                        'profesi_kerja_id' => $profesi->id,
                        'jurusan_kuliah_id' => null,
                    ]);
                }
            }
        }
    }
}
