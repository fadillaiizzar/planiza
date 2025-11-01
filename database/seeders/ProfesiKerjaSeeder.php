<?php

namespace Database\Seeders;

use App\Models\ProfesiKerja;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProfesiKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profesiPerJurusan = [
            'TKR' => [
                ['nama_profesi_kerja' => 'Teknisi Otomotif', 'deskripsi' => 'Mekanik dan perbaikan kendaraan', 'info_skill' => 'Diagnosa Mesin', 'info_jurusan' => 'TKR'],
                ['nama_profesi_kerja' => 'Operator Mesin Industri', 'deskripsi' => 'Mengoperasikan mesin produksi', 'info_skill' => 'Pengaturan CNC', 'info_jurusan' => 'TKR'],
                ['nama_profesi_kerja' => 'Teknisi Listrik Otomotif', 'deskripsi' => 'Perawatan sistem listrik kendaraan', 'info_skill' => 'Sistem Kelistrikan Mobil', 'info_jurusan' => 'TKR'],
                ['nama_profesi_kerja' => 'Mekanik Motor', 'deskripsi' => 'Perawatan dan servis sepeda motor', 'info_skill' => 'Perawatan Mesin Motor', 'info_jurusan' => 'TKR'],
                ['nama_profesi_kerja' => 'Teknisi Kendaraan Berat', 'deskripsi' => 'Perbaikan kendaraan besar seperti truk dan bus', 'info_skill' => 'Sistem Suspensi Berat', 'info_jurusan' => 'TKR'],
                ['nama_profesi_kerja' => 'Teknisi Diagnosa Mesin', 'deskripsi' => 'Mengidentifikasi masalah mesin dengan perangkat elektronik', 'info_skill' => 'Scanner ECU', 'info_jurusan' => 'TKR'],
            ],
            'SIJA' => [
                ['nama_profesi_kerja' => 'Programmer', 'deskripsi' => 'Pengembang perangkat lunak', 'info_skill' => 'Algoritma & Struktur Data', 'info_jurusan' => 'SIJA'],
                ['nama_profesi_kerja' => 'Web Developer', 'deskripsi' => 'Membangun aplikasi web', 'info_skill' => 'Front-End Framework', 'info_jurusan' => 'SIJA'],
                ['nama_profesi_kerja' => 'Network Engineer', 'deskripsi' => 'Mengelola jaringan komputer', 'info_skill' => 'Konfigurasi Router & Switch', 'info_jurusan' => 'SIJA'],
                ['nama_profesi_kerja' => 'System Analyst', 'deskripsi' => 'Menganalisis kebutuhan sistem', 'info_skill' => 'Analisis Sistem', 'info_jurusan' => 'SIJA'],
                ['nama_profesi_kerja' => 'Database Administrator', 'deskripsi' => 'Mengelola basis data', 'info_skill' => 'SQL & Optimisasi Database', 'info_jurusan' => 'SIJA'],
                ['nama_profesi_kerja' => 'Cybersecurity Analyst', 'deskripsi' => 'Melindungi sistem dan jaringan', 'info_skill' => 'Keamanan Jaringan', 'info_jurusan' => 'SIJA'],
            ],
            'TAV' => [
                ['nama_profesi_kerja' => 'Teknisi Audio Visual', 'deskripsi' => 'Perawatan alat audio-visual', 'info_skill' => 'Kalibrasi AV', 'info_jurusan' => 'TAV'],
                ['nama_profesi_kerja' => 'Video Editor', 'deskripsi' => 'Mengedit video dan animasi', 'info_skill' => 'Adobe Premiere', 'info_jurusan' => 'TAV'],
                ['nama_profesi_kerja' => 'Video Motion Specialist', 'deskripsi' => 'Membuat video animasi dan efek visual untuk kebutuhan siaran dan media digital.', 'info_skill' => '3D Animation, Motion Tracking, Compositing', 'info_jurusan' => 'TAV'],
                ['nama_profesi_kerja' => 'Sound Designer', 'deskripsi' => 'Membuat efek suara dan mixing', 'info_skill' => 'Audio Mixing', 'info_jurusan' => 'TAV'],
                ['nama_profesi_kerja' => 'Motion Graphics Designer', 'deskripsi' => 'Membuat animasi grafis bergerak', 'info_skill' => 'After Effects', 'info_jurusan' => 'TAV'],
                ['nama_profesi_kerja' => 'Broadcast Technician', 'deskripsi' => 'Mengoperasikan siaran televisi', 'info_skill' => 'Pengoperasian Kamera Siaran', 'info_jurusan' => 'TAV'],
            ],
            'TITL' => [
                ['nama_profesi_kerja' => 'Teknisi Telekomunikasi', 'deskripsi' => 'Instalasi jaringan komunikasi', 'info_skill' => 'Konfigurasi Jaringan', 'info_jurusan' => 'TITL'],
                ['nama_profesi_kerja' => 'Teknisi Fiber Optik', 'deskripsi' => 'Perawatan kabel dan jaringan fiber', 'info_skill' => 'Splicing Fiber', 'info_jurusan' => 'TITL'],
                ['nama_profesi_kerja' => 'Operator BTS', 'deskripsi' => 'Mengelola tower dan komunikasi', 'info_skill' => 'Maintenance BTS', 'info_jurusan' => 'TITL'],
                ['nama_profesi_kerja' => 'Network Installer', 'deskripsi' => 'Instalasi jaringan LAN/WAN', 'info_skill' => 'Kabelisasi LAN', 'info_jurusan' => 'TITL'],
                ['nama_profesi_kerja' => 'Telecom Technician', 'deskripsi' => 'Perawatan perangkat telekomunikasi', 'info_skill' => 'Perangkat Switching', 'info_jurusan' => 'TITL'],
                ['nama_profesi_kerja' => 'Satellite Technician', 'deskripsi' => 'Instalasi dan perawatan satelit', 'info_skill' => 'Parabola & Receiver', 'info_jurusan' => 'TITL'],
            ],
            'TP' => [
                ['nama_profesi_kerja' => 'Operator Mesin Bubut', 'deskripsi' => 'Mengoperasikan mesin bubut untuk membentuk komponen logam sesuai desain teknik', 'info_skill' => 'Pengoperasian Mesin Bubut', 'info_jurusan' => 'TP'],
                ['nama_profesi_kerja' => 'Operator Mesin CNC', 'deskripsi' => 'Menjalankan dan memprogram mesin CNC untuk proses pemesinan presisi tinggi', 'info_skill' => 'Pemrograman CNC', 'info_jurusan' => 'TP'],
                ['nama_profesi_kerja' => 'Teknisi Produksi Manufaktur', 'deskripsi' => 'Menangani perakitan dan proses produksi komponen mekanik di industri manufaktur', 'info_skill' => 'Perakitan dan Proses Produksi', 'info_jurusan' => 'TP'],
                ['nama_profesi_kerja' => 'Teknisi Perawatan Mesin Industri', 'deskripsi' => 'Melakukan perawatan dan perbaikan mesin produksi agar tetap berfungsi optimal', 'info_skill' => 'Maintenance Mesin Industri', 'info_jurusan' => 'TP'],
                ['nama_profesi_kerja' => 'Quality Control Produk Mekanik', 'deskripsi' => 'Melakukan pemeriksaan kualitas hasil produksi komponen logam dan mesin', 'info_skill' => 'Pengukuran Presisi dan Kalibrasi', 'info_jurusan' => 'TP'],
                ['nama_profesi_kerja' => 'Drafter Mesin', 'deskripsi' => 'Membuat gambar teknik dan desain komponen mesin menggunakan CAD', 'info_skill' => 'Gambar Teknik dan CAD', 'info_jurusan' => 'TP'],
            ],
            'DPIB' => [
                ['nama_profesi_kerja' => 'Desainer Interior', 'deskripsi' => 'Perancang interior', 'info_skill' => 'Interior Rendering', 'info_jurusan' => 'DPIB'],
                ['nama_profesi_kerja' => 'Arsitek', 'deskripsi' => 'Perancangan bangunan', 'info_skill' => 'AutoCAD', 'info_jurusan' => 'DPIB'],
                ['nama_profesi_kerja' => 'Desainer Furniture', 'deskripsi' => 'Mendesain dan membuat furniture', 'info_skill' => 'Furniture Modeling', 'info_jurusan' => 'DPIB'],
                ['nama_profesi_kerja' => 'Project Architect', 'deskripsi' => 'Memimpin proyek desain bangunan', 'info_skill' => 'Project Management', 'info_jurusan' => 'DPIB'],
                ['nama_profesi_kerja' => '3D Visualizer', 'deskripsi' => 'Membuat visualisasi 3D desain interior', 'info_skill' => '3DS Max', 'info_jurusan' => 'DPIB'],
                ['nama_profesi_kerja' => 'Desainer Retail', 'deskripsi' => 'Mendesain toko dan display', 'info_skill' => 'Store Layout', 'info_jurusan' => 'DPIB'],
            ],
            'KGSP' => [
                ['nama_profesi_kerja' => 'Manajer Fasilitas Gedung', 'deskripsi' => 'Bertanggung jawab atas pengelolaan, operasional, dan pemeliharaan seluruh fasilitas bangunan.', 'info_skill' => 'Facility Management, Building Operations, Leadership', 'info_jurusan' => 'KGSP'],
                ['nama_profesi_kerja' => 'Teknisi Pemeliharaan Bangunan', 'deskripsi' => 'Melakukan perawatan, perbaikan, dan pengecekan rutin terhadap struktur dan fasilitas bangunan.', 'info_skill' => 'Maintenance Bangunan, Plumbing, Perbaikan Fasilitas', 'info_jurusan' => 'KGSP'],
                ['nama_profesi_kerja' => 'Supervisor Konstruksi Gedung', 'deskripsi' => 'Mengawasi pelaksanaan proyek pembangunan dan memastikan kualitas serta keselamatan kerja di lapangan.', 'info_skill' => 'Construction Supervision, Quality Control, Manajemen Proyek', 'info_jurusan' => 'KGSP'],
                ['nama_profesi_kerja' => 'Ahli Sanitasi Bangunan', 'deskripsi' => 'Menangani sistem sanitasi, drainase, dan pengelolaan limbah bangunan agar sesuai standar kebersihan.', 'info_skill' => 'Sistem Sanitasi, Plumbing, Drainase Bangunan', 'info_jurusan' => 'KGSP'],
                ['nama_profesi_kerja' => 'Teknisi Instalasi Gedung', 'deskripsi' => 'Melakukan instalasi dan perawatan sistem listrik, air, dan ventilasi di dalam bangunan.', 'info_skill' => 'Electrical Wiring, HVAC System, Instalasi Gedung', 'info_jurusan' => 'KGSP'],
                ['nama_profesi_kerja' => 'Estimator Konstruksi', 'deskripsi' => 'Menghitung kebutuhan material, biaya, dan tenaga kerja pada proyek pembangunan gedung.', 'info_skill' => 'Estimasi Biaya, Analisis Struktur, Manajemen Proyek', 'info_jurusan' => 'KGSP'],
            ],
            'DKV' => [
                ['nama_profesi_kerja' => 'Desainer Grafis', 'deskripsi' => 'Membuat desain visual', 'info_skill' => 'Adobe Illustrator', 'info_jurusan' => 'DKV'],
                ['nama_profesi_kerja' => 'Ilustrator', 'deskripsi' => 'Membuat ilustrasi digital', 'info_skill' => 'Digital Painting', 'info_jurusan' => 'DKV'],
                ['nama_profesi_kerja' => 'Animator', 'deskripsi' => 'Membuat animasi kreatif', 'info_skill' => '2D Animation', 'info_jurusan' => 'DKV'],
                ['nama_profesi_kerja' => 'Motion Designer', 'deskripsi' => 'Membuat animasi grafis', 'info_skill' => 'After Effects', 'info_jurusan' => 'DKV'],
                ['nama_profesi_kerja' => 'Visual Storyteller', 'deskripsi' => 'Menyampaikan cerita lewat visual', 'info_skill' => 'Storyboarding', 'info_jurusan' => 'DKV'],
                ['nama_profesi_kerja' => 'Art Director', 'deskripsi' => 'Mengonsep dan mengarahkan tampilan visual dalam proyek kreatif seperti iklan, kampanye, dan branding.', 'info_skill' => 'Creative Direction, Branding, Visual Concept', 'info_jurusan' => 'DKV'],
            ],
            'GEO' => [
                ['nama_profesi_kerja' => 'Surveyor', 'deskripsi' => 'Pengukuran tanah dan pemetaan', 'info_skill' => 'Total Station', 'info_jurusan' => 'GEO'],
                ['nama_profesi_kerja' => 'Geomatik', 'deskripsi' => 'Pengolahan data geospasial', 'info_skill' => 'GIS Analysis', 'info_jurusan' => 'GEO'],
                ['nama_profesi_kerja' => 'Teknisi Pemetaan', 'deskripsi' => 'Membuat peta dan survei lapangan', 'info_skill' => 'GPS Mapping', 'info_jurusan' => 'GEO'],
                ['nama_profesi_kerja' => 'Cartographer', 'deskripsi' => 'Membuat peta tematik dan digital', 'info_skill' => 'Mapping Software', 'info_jurusan' => 'GEO'],
                ['nama_profesi_kerja' => 'Remote Sensing Analyst', 'deskripsi' => 'Analisis citra satelit', 'info_skill' => 'Satellite Imagery', 'info_jurusan' => 'GEO'],
                ['nama_profesi_kerja' => 'Ahli Sistem Informasi Geografis', 'deskripsi' => 'Mengelola, menganalisis, dan memvisualisasikan data spasial menggunakan sistem GIS.', 'info_skill' => 'ArcGIS, Spatial Database, Data Visualization', 'info_jurusan' => 'GEO'],
            ],
        ];
        foreach ($profesiPerJurusan as $jurusanName => $profesis) {
            foreach ($profesis as $profesi) {
                ProfesiKerja::create($profesi);
            }
        }
    }
}
