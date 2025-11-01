<?php

namespace Database\Seeders;

use App\Models\Tes;
use App\Models\SoalTes;
use App\Models\OpsiJawaban;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tes
        $tes = Tes::create([
            'nama_tes' => 'Minat Bakat',
            'is_active' => true,
        ]);

        // Soal 1
        $soal1 = SoalTes::create([
            'tes_id' => $tes->id,
            'isi_pertanyaan' => 'Aktivitas apa yang paling kamu sukai?',
            'jenis_soal' => 'single',
            'max_select' => 1,
        ]);

        $opsi1 = [
            ['soal_tes_id' => $soal1->id, 'kategori_minat_id' => 4, 'profesi_kerja_id' => null, 'isi_opsi' => 'Membantu orang lain atau mengajar'],
            ['soal_tes_id' => $soal1->id, 'kategori_minat_id' => 3, 'profesi_kerja_id' => null, 'isi_opsi' => 'Menggambar, melukis, atau desain'],
            ['soal_tes_id' => $soal1->id, 'kategori_minat_id' => 6, 'profesi_kerja_id' => null, 'isi_opsi' => 'Mengatur data atau dokumen'],
            ['soal_tes_id' => $soal1->id, 'kategori_minat_id' => 2, 'profesi_kerja_id' => null, 'isi_opsi' => 'Melakukan eksperimen atau penelitian'],
            ['soal_tes_id' => $soal1->id, 'kategori_minat_id' => 1, 'profesi_kerja_id' => null, 'isi_opsi' => 'Memperbaiki atau merakit mesin'],
            ['soal_tes_id' => $soal1->id, 'kategori_minat_id' => 5, 'profesi_kerja_id' => null, 'isi_opsi' => 'Mengelola tim atau berbisnis'],
        ];
        foreach ($opsi1 as $data) {
            OpsiJawaban::create($data);
        }

        // Soal 2
        $soal2 = SoalTes::create([
            'tes_id' => $tes->id,
            'isi_pertanyaan' => 'Jika diberi tugas kelompok, peran apa yang biasanya kamu ambil?',
            'jenis_soal' => 'single',
            'max_select' => 1,
        ]);

        $opsi2 = [
            ['soal_tes_id' => $soal2->id, 'kategori_minat_id' => 2, 'profesi_kerja_id' => null, 'isi_opsi' => 'Menganalisis masalah dan mencari solusi'],
            ['soal_tes_id' => $soal2->id, 'kategori_minat_id' => 1, 'profesi_kerja_id' => null, 'isi_opsi' => 'Bertugas memegang alat dan praktek langsung'],
            ['soal_tes_id' => $soal2->id, 'kategori_minat_id' => 3, 'profesi_kerja_id' => null, 'isi_opsi' => 'Membuat presentasi atau desain tampilan'],
            ['soal_tes_id' => $soal2->id, 'kategori_minat_id' => 6, 'profesi_kerja_id' => null, 'isi_opsi' => 'Mendata hasil kerja dan membuat laporan'],
            ['soal_tes_id' => $soal2->id, 'kategori_minat_id' => 5, 'profesi_kerja_id' => null, 'isi_opsi' => 'Mengatur strategi kelompok agar lebih terarah'],
            ['soal_tes_id' => $soal2->id, 'kategori_minat_id' => 4, 'profesi_kerja_id' => null, 'isi_opsi' => 'Menjadi penengah dan membantu teman yang kesulitan'],
        ];
        foreach ($opsi2 as $data) {
            OpsiJawaban::create($data);
        }

        // Soal 3
        $soal3 = SoalTes::create([
            'tes_id' => $tes->id,
            'isi_pertanyaan' => 'Jika ada waktu luang, kegiatan apa yang paling sering kamu lakukan?',
            'jenis_soal' => 'single',
            'max_select' => 1,
        ]);

        $opsi3 = [
            ['soal_tes_id' => $soal3->id, 'kategori_minat_id' => 4, 'profesi_kerja_id' => null, 'isi_opsi' => 'Mengajar adik/teman, ikut kegiatan sosial'],
            ['soal_tes_id' => $soal3->id, 'kategori_minat_id' => 1, 'profesi_kerja_id' => null, 'isi_opsi' => 'Merakit atau memperbaiki barang'],
            ['soal_tes_id' => $soal3->id, 'kategori_minat_id' => 5, 'profesi_kerja_id' => null, 'isi_opsi' => 'Berjualan online atau ikut organisasi'],
            ['soal_tes_id' => $soal3->id, 'kategori_minat_id' => 2, 'profesi_kerja_id' => null, 'isi_opsi' => 'Membaca buku atau artikel sains/teknologi'],
            ['soal_tes_id' => $soal3->id, 'kategori_minat_id' => 6, 'profesi_kerja_id' => null, 'isi_opsi' => 'Merapikan data, dokumen, atau koleksi pribadi'],
            ['soal_tes_id' => $soal3->id, 'kategori_minat_id' => 3, 'profesi_kerja_id' => null, 'isi_opsi' => 'Menggambar, membuat video, atau desain digital'],
        ];
        foreach ($opsi3 as $data) {
            OpsiJawaban::create($data);
        }

        // Soal 4
        $soal4 = SoalTes::create([
            'tes_id' => $tes->id,
            'isi_pertanyaan' => 'Kemampuan atau skill apa yang paling kamu kuasai?',
            'jenis_soal' => 'multi',
            'max_select' => 3,
        ]);

        $opsi4 = [
            ['soal_tes_id' => $soal4->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 1,  'isi_opsi' => 'Servis kendaraan'],
            ['soal_tes_id' => $soal4->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 7,  'isi_opsi' => 'Buat aplikasi'],
            ['soal_tes_id' => $soal4->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 13, 'isi_opsi' => 'Instal audio'],
            ['soal_tes_id' => $soal4->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 14, 'isi_opsi' => 'Edit video'],
            ['soal_tes_id' => $soal4->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 19, 'isi_opsi' => 'Pasang jaringan'],
            ['soal_tes_id' => $soal4->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 20, 'isi_opsi' => 'Sambung fiber'],
            ['soal_tes_id' => $soal4->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 25, 'isi_opsi' => 'Operasi bubut'],
            ['soal_tes_id' => $soal4->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 26, 'isi_opsi' => 'Operasi CNC'],
            ['soal_tes_id' => $soal4->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 31, 'isi_opsi' => 'Desain interior'],
            ['soal_tes_id' => $soal4->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 32, 'isi_opsi' => 'Gambar bangunan'],
            ['soal_tes_id' => $soal4->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 37, 'isi_opsi' => 'Kelola gedung'],
            ['soal_tes_id' => $soal4->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 38, 'isi_opsi' => 'Rawat bangunan'],
            ['soal_tes_id' => $soal4->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 43, 'isi_opsi' => 'Desain grafis'],
            ['soal_tes_id' => $soal4->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 44, 'isi_opsi' => 'Ilustrasi digital'],
            ['soal_tes_id' => $soal4->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 49, 'isi_opsi' => 'Ukur lahan'],
            ['soal_tes_id' => $soal4->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 50, 'isi_opsi' => 'Analisis peta'],
        ];
        foreach ($opsi4 as $data) {
            OpsiJawaban::create($data);
        }

        // Soal 5
        $soal5 = SoalTes::create([
            'tes_id' => $tes->id,
            'isi_pertanyaan' => 'Gaya kerja seperti apa yang paling kamu sukai?',
            'jenis_soal' => 'multi',
            'max_select' => 3,
        ]);

        $opsi5 = [
            ['soal_tes_id' => $soal5->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 2, 'isi_opsi' => 'Kerja pabrik teratur'],
            ['soal_tes_id' => $soal5->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 3, 'isi_opsi' => 'Teknis lapangan'],
            ['soal_tes_id' => $soal5->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 8, 'isi_opsi' => 'Kreatif digital'],
            ['soal_tes_id' => $soal5->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 9, 'isi_opsi' => 'Analitis sistem'],
            ['soal_tes_id' => $soal5->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 15, 'isi_opsi' => 'Visual dinamis'],
            ['soal_tes_id' => $soal5->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 21, 'isi_opsi' => 'Kerja lapangan'],
            ['soal_tes_id' => $soal5->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 27, 'isi_opsi' => 'Kerja tim produksi'],
            ['soal_tes_id' => $soal5->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 28, 'isi_opsi' => 'Fokus presisi'],
            ['soal_tes_id' => $soal5->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 33, 'isi_opsi' => 'Desain detail'],
            ['soal_tes_id' => $soal5->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 34, 'isi_opsi' => 'Koordinasi proyek'],
            ['soal_tes_id' => $soal5->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 39, 'isi_opsi' => 'Pengawasan lapangan'],
            ['soal_tes_id' => $soal5->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 40, 'isi_opsi' => 'Standar kebersihan'],
            ['soal_tes_id' => $soal5->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 45, 'isi_opsi' => 'Kreatif fleksibel'],
            ['soal_tes_id' => $soal5->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 46, 'isi_opsi' => 'Kolaborasi ide'],
            ['soal_tes_id' => $soal5->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 51, 'isi_opsi' => 'Survey lapangan'],
            ['soal_tes_id' => $soal5->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 52, 'isi_opsi' => 'Analisis peta'],
        ];
        foreach ($opsi5 as $data) {
            OpsiJawaban::create($data);
        }

        // Soal 6
        $soal6 = SoalTes::create([
            'tes_id' => $tes->id,
            'isi_pertanyaan' => 'Pekerjaan apa yang paling menarik bagimu?',
            'jenis_soal' => 'multi',
            'max_select' => 3,
        ]);

        $opsi6 = [
            ['soal_tes_id' => $soal6->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 4,  'isi_opsi' => 'Mekanik Motor'],
            ['soal_tes_id' => $soal6->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 5,  'isi_opsi' => 'Teknisi Alat Berat'],
            ['soal_tes_id' => $soal6->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 10, 'isi_opsi' => 'Analis Sistem'],
            ['soal_tes_id' => $soal6->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 11, 'isi_opsi' => 'Admin Database'],
            ['soal_tes_id' => $soal6->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 16, 'isi_opsi' => 'Desainer Suara'],
            ['soal_tes_id' => $soal6->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 17, 'isi_opsi' => 'Desainer Motion'],
            ['soal_tes_id' => $soal6->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 22, 'isi_opsi' => 'Pemasang Jaringan'],
            ['soal_tes_id' => $soal6->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 23, 'isi_opsi' => 'Teknisi Telekom'],
            ['soal_tes_id' => $soal6->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 29, 'isi_opsi' => 'Quality Control'],
            ['soal_tes_id' => $soal6->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 35, 'isi_opsi' => 'Desainer 3D'],
            ['soal_tes_id' => $soal6->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 41, 'isi_opsi' => 'Teknisi Gedung'],
            ['soal_tes_id' => $soal6->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 42, 'isi_opsi' => 'Estimator Konstruksi'],
            ['soal_tes_id' => $soal6->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 47, 'isi_opsi' => 'Visual Storyteller'],
            ['soal_tes_id' => $soal6->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 48, 'isi_opsi' => 'Art Director'],
            ['soal_tes_id' => $soal6->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 53, 'isi_opsi' => 'Analis Citra Satelit'],
            ['soal_tes_id' => $soal6->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 54, 'isi_opsi' => 'Ahli GIS'],
        ];
        foreach ($opsi6 as $data) {
            OpsiJawaban::create($data);
        }

        // Soal 7
        $soal7 = SoalTes::create([
            'tes_id' => $tes->id,
            'isi_pertanyaan' => 'Dari berbagai bidang kegiatan, mana yang paling menggambarkan dirimu?',
            'jenis_soal' => 'multi',
            'max_select' => 3,
        ]);

        $opsi7 = [
            ['soal_tes_id' => $soal7->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 6,  'isi_opsi' => 'Diagnosa Mesin'],
            ['soal_tes_id' => $soal7->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 7,  'isi_opsi' => 'Menulis Kode'],
            ['soal_tes_id' => $soal7->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 12, 'isi_opsi' => 'Analisis Keamanan'],
            ['soal_tes_id' => $soal7->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 18, 'isi_opsi' => 'Teknisi Studio'],
            ['soal_tes_id' => $soal7->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 23, 'isi_opsi' => 'Perawatan Telekom'],
            ['soal_tes_id' => $soal7->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 24, 'isi_opsi' => 'Instalasi Satelit'],
            ['soal_tes_id' => $soal7->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 30, 'isi_opsi' => 'Gambar Teknik'],
            ['soal_tes_id' => $soal7->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 31, 'isi_opsi' => 'Desain Interior'],
            ['soal_tes_id' => $soal7->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 32, 'isi_opsi' => 'Rancang Bangunan'],
            ['soal_tes_id' => $soal7->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 41, 'isi_opsi' => 'Instalasi Gedung'],
            ['soal_tes_id' => $soal7->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 42, 'isi_opsi' => 'Hitung Konstruksi'],
            ['soal_tes_id' => $soal7->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 47, 'isi_opsi' => 'Desain Cerita Visual'],
            ['soal_tes_id' => $soal7->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 48, 'isi_opsi' => 'Arahkan Desain'],
            ['soal_tes_id' => $soal7->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 53, 'isi_opsi' => 'Analisis Citra'],
            ['soal_tes_id' => $soal7->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 54, 'isi_opsi' => 'Peta Digital'],
        ];
        foreach ($opsi7 as $data) {
            OpsiJawaban::create($data);
        }

        // Soal 8
        $soal8 = SoalTes::create([
            'tes_id' => $tes->id,
            'isi_pertanyaan' => 'Hal apa yang kamu rasa paling bisa kamu lakukan dengan baik dibanding orang lain?',
            'jenis_soal' => 'multi',
            'max_select' => 3,
        ]);

        $opsi8 = [
            ['soal_tes_id' => $soal8->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 1,  'isi_opsi' => 'Servis Motor Cepat'],
            ['soal_tes_id' => $soal8->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 2,  'isi_opsi' => 'Mekanik Mesin'],
            ['soal_tes_id' => $soal8->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 8,  'isi_opsi' => 'Buat Website'],
            ['soal_tes_id' => $soal8->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 11, 'isi_opsi' => 'Kelola Database'],
            ['soal_tes_id' => $soal8->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 13, 'isi_opsi' => 'Set Audio'],
            ['soal_tes_id' => $soal8->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 14, 'isi_opsi' => 'Edit Video Kreatif'],
            ['soal_tes_id' => $soal8->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 24, 'isi_opsi' => 'Pasang Satelit'],
            ['soal_tes_id' => $soal8->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 25, 'isi_opsi' => 'Jalankan Mesin Bubut'],
            ['soal_tes_id' => $soal8->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 26, 'isi_opsi' => 'Kontrol Mesin CNC'],
            ['soal_tes_id' => $soal8->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 32, 'isi_opsi' => 'Rancang Bangunan'],
            ['soal_tes_id' => $soal8->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 36, 'isi_opsi' => 'Tata Retail'],
            ['soal_tes_id' => $soal8->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 37, 'isi_opsi' => 'Atur Gedung'],
            ['soal_tes_id' => $soal8->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 38, 'isi_opsi' => 'Rawat Gedung'],
            ['soal_tes_id' => $soal8->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 43, 'isi_opsi' => 'Desain Grafis Kreatif'],
            ['soal_tes_id' => $soal8->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 44, 'isi_opsi' => 'Bikin Ilustrasi'],
        ];
        foreach ($opsi8 as $data) {
            OpsiJawaban::create($data);
        }

        // Soal 9
        $soal9 = SoalTes::create([
            'tes_id' => $tes->id,
            'isi_pertanyaan' => 'Kegiatan seperti apa yang paling ingin kamu tekuni di masa depan?',
            'jenis_soal' => 'multi',
            'max_select' => 3,
        ]);

        $opsi9 = [
            ['soal_tes_id' => $soal9->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 2,  'isi_opsi' => 'Mesin Industri'],
            ['soal_tes_id' => $soal9->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 4,  'isi_opsi' => 'Servis Motor'],
            ['soal_tes_id' => $soal9->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 7,  'isi_opsi' => 'Coding Program'],
            ['soal_tes_id' => $soal9->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 9,  'isi_opsi' => 'Bangun Jaringan'],
            ['soal_tes_id' => $soal9->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 12, 'isi_opsi' => 'Amankan Data'],
            ['soal_tes_id' => $soal9->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 15, 'isi_opsi' => 'Animasi Gerak'],
            ['soal_tes_id' => $soal9->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 16, 'isi_opsi' => 'Bikin Efek Suara'],
            ['soal_tes_id' => $soal9->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 20, 'isi_opsi' => 'Pasang Fiber'],
            ['soal_tes_id' => $soal9->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 25, 'isi_opsi' => 'Mesin Bubut'],
            ['soal_tes_id' => $soal9->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 29, 'isi_opsi' => 'Cek Kualitas Produk'],
            ['soal_tes_id' => $soal9->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 30, 'isi_opsi' => 'Gambar Teknik'],
            ['soal_tes_id' => $soal9->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 33, 'isi_opsi' => 'Furniture Interior'],
            ['soal_tes_id' => $soal9->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 45, 'isi_opsi' => 'Bikin Motion Graphic'],
            ['soal_tes_id' => $soal9->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 46, 'isi_opsi' => 'Visual Kreatif'],
            ['soal_tes_id' => $soal9->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 51, 'isi_opsi' => 'Pemetaan Lahan'],
        ];
        foreach ($opsi9 as $data) {
            OpsiJawaban::create($data);
        }

        // Soal 10
        $soal10 = SoalTes::create([
            'tes_id' => $tes->id,
            'isi_pertanyaan' => 'Hal atau bidang apa yang paling ingin kamu pelajari lebih dalam?',
            'jenis_soal' => 'multi',
            'max_select' => 3,
        ]);

        $opsi10 = [
            ['soal_tes_id' => $soal10->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 5,  'isi_opsi' => 'Kendaraan Berat'],
            ['soal_tes_id' => $soal10->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 6,  'isi_opsi' => 'Diagnosa Mesin'],
            ['soal_tes_id' => $soal10->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 11, 'isi_opsi' => 'Database Admin'],
            ['soal_tes_id' => $soal10->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 12, 'isi_opsi' => 'Keamanan Sistem'],
            ['soal_tes_id' => $soal10->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 17, 'isi_opsi' => 'Motion Graphic'],
            ['soal_tes_id' => $soal10->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 18, 'isi_opsi' => 'Broadcast TV'],
            ['soal_tes_id' => $soal10->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 21, 'isi_opsi' => 'Operator BTS'],
            ['soal_tes_id' => $soal10->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 22, 'isi_opsi' => 'Jaringan Kabel'],
            ['soal_tes_id' => $soal10->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 23, 'isi_opsi' => 'Data Komunikasi'],
            ['soal_tes_id' => $soal10->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 26, 'isi_opsi' => 'Mesin CNC'],
            ['soal_tes_id' => $soal10->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 30, 'isi_opsi' => 'Gambar Mesin'],
            ['soal_tes_id' => $soal10->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 34, 'isi_opsi' => 'Proyek Arsitektur'],
            ['soal_tes_id' => $soal10->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 46, 'isi_opsi' => 'Desain Motion'],
            ['soal_tes_id' => $soal10->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 48, 'isi_opsi' => 'Data Geospasial'],
            ['soal_tes_id' => $soal10->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 52, 'isi_opsi' => 'Kartografi Digital'],
        ];
        foreach ($opsi10 as $data) {
            OpsiJawaban::create($data);
        }
    }
}
