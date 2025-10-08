<?php

namespace Database\Seeders;

use App\Models\Tes;
use App\Models\Role;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Materi;
use App\Models\Jurusan;
use App\Models\Rencana;
use App\Models\SoalTes;
use App\Models\Industri;
use App\Models\OpsiJawaban;
use App\Models\TopikMateri;
use App\Models\ProfesiKerja;
use App\Models\KategoriMinat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Role
        $administratorRole = Role::create(['nama_role' => 'Administrator']);
        $adminRole = Role::create(['nama_role' => 'Admin']);
        $siswaRole = Role::create(['nama_role' => 'Siswa']);

        // User Role Administrator dan Admin
        User::create([
            'name' => 'Administrator',
            'username' => 'administrator',
            'password' => Hash::make('administrator'),
            'role_id' => $administratorRole->id,
        ]);

        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role_id' => $adminRole->id,
        ]);

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

        // User Role Siswa
        $kelas = Kelas::inRandomOrder()->first();
        $jurusan = Jurusan::inRandomOrder()->first();
        $rencana = Rencana::inRandomOrder()->first();

        $userSiswa = User::create([
            'name' => 'Izapizay',
            'username' => 'izapizay',
            'password' => Hash::make('izapizay'),
            'role_id' => $siswaRole->id,
        ]);

        $userSiswa->siswa()->create([
            'kelas_id' => $kelas->id,
            'jurusan_id' => $jurusan->id,
            'rencana_id' => $rencana->id,
            'no_hp' => '081234567890',
        ]);

        // Profesi Kerja
        $profesiPerJurusan = [
            'TKR' => [
                ['nama_profesi_kerja' => 'Teknisi Otomotif', 'gaji' => 3500000, 'deskripsi' => 'Mekanik dan perbaikan kendaraan', 'info_skill' => 'Diagnosa Mesin', 'info_jurusan' => 'TKR'],
                ['nama_profesi_kerja' => 'Operator Mesin Industri', 'gaji' => 3300000, 'deskripsi' => 'Mengoperasikan mesin produksi', 'info_skill' => 'Pengaturan CNC', 'info_jurusan' => 'TKR'],
                ['nama_profesi_kerja' => 'Teknisi Listrik Otomotif', 'gaji' => 3600000, 'deskripsi' => 'Perawatan sistem listrik kendaraan', 'info_skill' => 'Sistem Kelistrikan Mobil', 'info_jurusan' => 'TKR'],
                ['nama_profesi_kerja' => 'Mekanik Motor', 'gaji' => 3200000, 'deskripsi' => 'Perawatan dan servis sepeda motor', 'info_skill' => 'Perawatan Mesin Motor', 'info_jurusan' => 'TKR'],
                ['nama_profesi_kerja' => 'Teknisi Kendaraan Berat', 'gaji' => 3700000, 'deskripsi' => 'Perbaikan kendaraan besar seperti truk dan bus', 'info_skill' => 'Sistem Suspensi Berat', 'info_jurusan' => 'TKR'],
                ['nama_profesi_kerja' => 'Teknisi Diagnosa Mesin', 'gaji' => 3800000, 'deskripsi' => 'Mengidentifikasi masalah mesin dengan perangkat elektronik', 'info_skill' => 'Scanner ECU', 'info_jurusan' => 'TKR'],
            ],
            'SIJA' => [
                ['nama_profesi_kerja' => 'Programmer', 'gaji' => 5000000, 'deskripsi' => 'Pengembang perangkat lunak', 'info_skill' => 'Algoritma & Struktur Data', 'info_jurusan' => 'SIJA'],
                ['nama_profesi_kerja' => 'Web Developer', 'gaji' => 4500000, 'deskripsi' => 'Membangun aplikasi web', 'info_skill' => 'Front-End Framework', 'info_jurusan' => 'SIJA'],
                ['nama_profesi_kerja' => 'Network Engineer', 'gaji' => 4800000, 'deskripsi' => 'Mengelola jaringan komputer', 'info_skill' => 'Konfigurasi Router & Switch', 'info_jurusan' => 'SIJA'],
                ['nama_profesi_kerja' => 'System Analyst', 'gaji' => 5100000, 'deskripsi' => 'Menganalisis kebutuhan sistem', 'info_skill' => 'Analisis Sistem', 'info_jurusan' => 'SIJA'],
                ['nama_profesi_kerja' => 'Database Administrator', 'gaji' => 4900000, 'deskripsi' => 'Mengelola basis data', 'info_skill' => 'SQL & Optimisasi Database', 'info_jurusan' => 'SIJA'],
                ['nama_profesi_kerja' => 'Cybersecurity Analyst', 'gaji' => 5200000, 'deskripsi' => 'Melindungi sistem dan jaringan', 'info_skill' => 'Keamanan Jaringan', 'info_jurusan' => 'SIJA'],
            ],
            'TAV' => [
                ['nama_profesi_kerja' => 'Teknisi Audio Visual', 'gaji' => 4000000, 'deskripsi' => 'Perawatan alat audio-visual', 'info_skill' => 'Kalibrasi AV', 'info_jurusan' => 'TAV'],
                ['nama_profesi_kerja' => 'Video Editor', 'gaji' => 4200000, 'deskripsi' => 'Mengedit video dan animasi', 'info_skill' => 'Adobe Premiere', 'info_jurusan' => 'TAV'],
                ['nama_profesi_kerja' => 'Video Motion Specialist', 'gaji' => 4500000, 'deskripsi' => 'Membuat video animasi dan efek visual untuk kebutuhan siaran dan media digital.', 'info_skill' => '3D Animation, Motion Tracking, Compositing', 'info_jurusan' => 'TAV'],
                ['nama_profesi_kerja' => 'Sound Designer', 'gaji' => 4300000, 'deskripsi' => 'Membuat efek suara dan mixing', 'info_skill' => 'Audio Mixing', 'info_jurusan' => 'TAV'],
                ['nama_profesi_kerja' => 'Motion Graphics Designer', 'gaji' => 4400000, 'deskripsi' => 'Membuat animasi grafis bergerak', 'info_skill' => 'After Effects', 'info_jurusan' => 'TAV'],
                ['nama_profesi_kerja' => 'Broadcast Technician', 'gaji' => 4100000, 'deskripsi' => 'Mengoperasikan siaran televisi', 'info_skill' => 'Pengoperasian Kamera Siaran', 'info_jurusan' => 'TAV'],
            ],
            'TITL' => [
                ['nama_profesi_kerja' => 'Teknisi Telekomunikasi', 'gaji' => 4200000, 'deskripsi' => 'Instalasi jaringan komunikasi', 'info_skill' => 'Konfigurasi Jaringan', 'info_jurusan' => 'TITL'],
                ['nama_profesi_kerja' => 'Teknisi Fiber Optik', 'gaji' => 4400000, 'deskripsi' => 'Perawatan kabel dan jaringan fiber', 'info_skill' => 'Splicing Fiber', 'info_jurusan' => 'TITL'],
                ['nama_profesi_kerja' => 'Operator BTS', 'gaji' => 4300000, 'deskripsi' => 'Mengelola tower dan komunikasi', 'info_skill' => 'Maintenance BTS', 'info_jurusan' => 'TITL'],
                ['nama_profesi_kerja' => 'Network Installer', 'gaji' => 4100000, 'deskripsi' => 'Instalasi jaringan LAN/WAN', 'info_skill' => 'Kabelisasi LAN', 'info_jurusan' => 'TITL'],
                ['nama_profesi_kerja' => 'Telecom Technician', 'gaji' => 4500000, 'deskripsi' => 'Perawatan perangkat telekomunikasi', 'info_skill' => 'Perangkat Switching', 'info_jurusan' => 'TITL'],
                ['nama_profesi_kerja' => 'Satellite Technician', 'gaji' => 4600000, 'deskripsi' => 'Instalasi dan perawatan satelit', 'info_skill' => 'Parabola & Receiver', 'info_jurusan' => 'TITL'],
            ],
            'TP' => [
                ['nama_profesi_kerja' => 'Operator Mesin Bubut', 'gaji' => 3800000, 'deskripsi' => 'Mengoperasikan mesin bubut untuk membentuk komponen logam sesuai desain teknik', 'info_skill' => 'Pengoperasian Mesin Bubut', 'info_jurusan' => 'TP'],
                ['nama_profesi_kerja' => 'Operator Mesin CNC', 'gaji' => 4200000, 'deskripsi' => 'Menjalankan dan memprogram mesin CNC untuk proses pemesinan presisi tinggi', 'info_skill' => 'Pemrograman CNC', 'info_jurusan' => 'TP'],
                ['nama_profesi_kerja' => 'Teknisi Produksi Manufaktur', 'gaji' => 4000000, 'deskripsi' => 'Menangani perakitan dan proses produksi komponen mekanik di industri manufaktur', 'info_skill' => 'Perakitan dan Proses Produksi', 'info_jurusan' => 'TP'],
                ['nama_profesi_kerja' => 'Teknisi Perawatan Mesin Industri', 'gaji' => 3900000, 'deskripsi' => 'Melakukan perawatan dan perbaikan mesin produksi agar tetap berfungsi optimal', 'info_skill' => 'Maintenance Mesin Industri', 'info_jurusan' => 'TP'],
                ['nama_profesi_kerja' => 'Quality Control Produk Mekanik', 'gaji' => 4100000, 'deskripsi' => 'Melakukan pemeriksaan kualitas hasil produksi komponen logam dan mesin', 'info_skill' => 'Pengukuran Presisi dan Kalibrasi', 'info_jurusan' => 'TP'],
                ['nama_profesi_kerja' => 'Drafter Mesin', 'gaji' => 3900000, 'deskripsi' => 'Membuat gambar teknik dan desain komponen mesin menggunakan CAD', 'info_skill' => 'Gambar Teknik dan CAD', 'info_jurusan' => 'TP'],
            ],
            'DPIB' => [
                ['nama_profesi_kerja' => 'Desainer Interior', 'gaji' => 4500000, 'deskripsi' => 'Perancang interior', 'info_skill' => 'Interior Rendering', 'info_jurusan' => 'DPIB'],
                ['nama_profesi_kerja' => 'Arsitek', 'gaji' => 5000000, 'deskripsi' => 'Perancangan bangunan', 'info_skill' => 'AutoCAD', 'info_jurusan' => 'DPIB'],
                ['nama_profesi_kerja' => 'Desainer Furniture', 'gaji' => 4300000, 'deskripsi' => 'Mendesain dan membuat furniture', 'info_skill' => 'Furniture Modeling', 'info_jurusan' => 'DPIB'],
                ['nama_profesi_kerja' => 'Project Architect', 'gaji' => 5200000, 'deskripsi' => 'Memimpin proyek desain bangunan', 'info_skill' => 'Project Management', 'info_jurusan' => 'DPIB'],
                ['nama_profesi_kerja' => '3D Visualizer', 'gaji' => 4400000, 'deskripsi' => 'Membuat visualisasi 3D desain interior', 'info_skill' => '3DS Max', 'info_jurusan' => 'DPIB'],
                ['nama_profesi_kerja' => 'Desainer Retail', 'gaji' => 4300000, 'deskripsi' => 'Mendesain toko dan display', 'info_skill' => 'Store Layout', 'info_jurusan' => 'DPIB'],
            ],
            'KGSP' => [
                ['nama_profesi_kerja' => 'Manajer Fasilitas Gedung', 'gaji' => 4500000, 'deskripsi' => 'Bertanggung jawab atas pengelolaan, operasional, dan pemeliharaan seluruh fasilitas bangunan.', 'info_skill' => 'Facility Management, Building Operations, Leadership', 'info_jurusan' => 'KGSP'],
                ['nama_profesi_kerja' => 'Teknisi Pemeliharaan Bangunan', 'gaji' => 3800000, 'deskripsi' => 'Melakukan perawatan, perbaikan, dan pengecekan rutin terhadap struktur dan fasilitas bangunan.', 'info_skill' => 'Maintenance Bangunan, Plumbing, Perbaikan Fasilitas', 'info_jurusan' => 'KGSP'],
                ['nama_profesi_kerja' => 'Supervisor Konstruksi Gedung', 'gaji' => 4200000, 'deskripsi' => 'Mengawasi pelaksanaan proyek pembangunan dan memastikan kualitas serta keselamatan kerja di lapangan.', 'info_skill' => 'Construction Supervision, Quality Control, Manajemen Proyek', 'info_jurusan' => 'KGSP'],
                ['nama_profesi_kerja' => 'Ahli Sanitasi Bangunan', 'gaji' => 4000000, 'deskripsi' => 'Menangani sistem sanitasi, drainase, dan pengelolaan limbah bangunan agar sesuai standar kebersihan.', 'info_skill' => 'Sistem Sanitasi, Plumbing, Drainase Bangunan', 'info_jurusan' => 'KGSP'],
                ['nama_profesi_kerja' => 'Teknisi Instalasi Gedung', 'gaji' => 3900000, 'deskripsi' => 'Melakukan instalasi dan perawatan sistem listrik, air, dan ventilasi di dalam bangunan.', 'info_skill' => 'Electrical Wiring, HVAC System, Instalasi Gedung', 'info_jurusan' => 'KGSP'],
            ],
            'DKV' => [
                ['nama_profesi_kerja' => 'Desainer Grafis', 'gaji' => 4000000, 'deskripsi' => 'Membuat desain visual', 'info_skill' => 'Adobe Illustrator', 'info_jurusan' => 'DKV'],
                ['nama_profesi_kerja' => 'Ilustrator', 'gaji' => 4200000, 'deskripsi' => 'Membuat ilustrasi digital', 'info_skill' => 'Digital Painting', 'info_jurusan' => 'DKV'],
                ['nama_profesi_kerja' => 'Animator', 'gaji' => 4500000, 'deskripsi' => 'Membuat animasi kreatif', 'info_skill' => '2D Animation', 'info_jurusan' => 'DKV'],
                ['nama_profesi_kerja' => 'Motion Designer', 'gaji' => 4400000, 'deskripsi' => 'Membuat animasi grafis', 'info_skill' => 'After Effects', 'info_jurusan' => 'DKV'],
                ['nama_profesi_kerja' => 'Visual Storyteller', 'gaji' => 4300000, 'deskripsi' => 'Menyampaikan cerita lewat visual', 'info_skill' => 'Storyboarding', 'info_jurusan' => 'DKV'],
            ],
            'GEO' => [
                ['nama_profesi_kerja' => 'Surveyor', 'gaji' => 3800000, 'deskripsi' => 'Pengukuran tanah dan pemetaan', 'info_skill' => 'Total Station', 'info_jurusan' => 'GEO'],
                ['nama_profesi_kerja' => 'Geomatik', 'gaji' => 4000000, 'deskripsi' => 'Pengolahan data geospasial', 'info_skill' => 'GIS Analysis', 'info_jurusan' => 'GEO'],
                ['nama_profesi_kerja' => 'Teknisi Pemetaan', 'gaji' => 3900000, 'deskripsi' => 'Membuat peta dan survei lapangan', 'info_skill' => 'GPS Mapping', 'info_jurusan' => 'GEO'],
                ['nama_profesi_kerja' => 'Cartographer', 'gaji' => 4100000, 'deskripsi' => 'Membuat peta tematik dan digital', 'info_skill' => 'Mapping Software', 'info_jurusan' => 'GEO'],
                ['nama_profesi_kerja' => 'Remote Sensing Analyst', 'gaji' => 4200000, 'deskripsi' => 'Analisis citra satelit', 'info_skill' => 'Satellite Imagery', 'info_jurusan' => 'GEO'],
            ],
        ];
        foreach ($profesiPerJurusan as $jurusanName => $profesis) {
            foreach ($profesis as $profesi) {
                ProfesiKerja::create($profesi);
            }
        }

        // Industri
        $industriList = [
            ['nama_industri' => 'Astra Daihatsu Motor', 'website' => 'https://www.astradaihatsu.co.id', 'alamat' => 'Jl. Gaya Motor No.8, Sunter, Jakarta Utara'],
            ['nama_industri' => 'Auto2000', 'website' => 'https://www.auto2000.co.id', 'alamat' => 'Jl. Gunung Sahari No.18, Jakarta Pusat'],
            ['nama_industri' => 'Toyota Motor Manufacturing Indonesia', 'website' => 'https://www.toyota.co.id', 'alamat' => 'Jl. MT Haryono Kav.8, Jakarta'],
            ['nama_industri' => 'PT. Suzuki Indomobil Motor', 'website' => 'https://www.suzuki.co.id', 'alamat' => 'Jl. Raya Cakung Cilincing, Jakarta Timur'],
            ['nama_industri' => 'Honda Prospect Motor', 'website' => 'https://www.honda-indonesia.com', 'alamat' => 'Jl. Gaya Motor Raya No.1, Sunter, Jakarta Utara'],
            ['nama_industri' => 'Mitsubishi Motors Krama Yudha Sales Indonesia', 'website' => 'https://www.mitsubishi-motors.co.id', 'alamat' => 'Jl. Raya Bogor KM.26, Jakarta Timur'],
            ['nama_industri' => 'Yamaha Indonesia Motor Manufacturing', 'website' => 'https://www.yamaha-motor.co.id', 'alamat' => 'Jl. Industri Selatan V, Kawasan Industri Pulo Gadung, Jakarta Timur'],
            ['nama_industri' => 'PT. Astra Honda Motor', 'website' => 'https://www.astra-honda.com', 'alamat' => 'Jl. Gaya Motor No.8, Sunter, Jakarta Utara'],
            ['nama_industri' => 'PO Haryanto', 'website' => 'https://www.haryanto.co.id', 'alamat' => 'Jl. Raya Bogor KM.33, Jakarta'],
            ['nama_industri' => 'PO Sumber Alam', 'website' => 'https://www.sumberalam.com', 'alamat' => 'Jl. Raya Solo KM.12, Yogyakarta'],
            ['nama_industri' => 'BMW Astra', 'website' => 'https://www.bmw.astra.co.id', 'alamat' => 'Jl. Gaya Motor Raya No.9, Sunter, Jakarta Utara'],
            ['nama_industri' => 'Nissan-Datsun Indonesia', 'website' => 'https://www.nissan.co.id', 'alamat' => 'Jl. Gaya Motor Selatan No.2, Jakarta'],

            ['nama_industri' => 'Gojek', 'website' => 'https://www.gojek.com', 'alamat' => 'Menara GoTo, Jakarta'],
            ['nama_industri' => 'Tokopedia', 'website' => 'https://www.tokopedia.com', 'alamat' => 'Jl. H. R. Rasuna Said Kav. B-11, Jakarta'],
            ['nama_industri' => 'Bukalapak', 'website' => 'https://www.bukalapak.com', 'alamat' => 'Jl. Asemka No.3, Jakarta'],
            ['nama_industri' => 'Traveloka', 'website' => 'https://www.traveloka.com', 'alamat' => 'Jl. Dr. Ide Anak Agung Gde Agung, Jakarta'],
            ['nama_industri' => 'Katalon', 'website' => 'https://www.katalon.com', 'alamat' => 'Jl. Sudirman Kav. 45, Jakarta'],
            ['nama_industri' => 'Telkom Indonesia', 'website' => 'https://www.telkom.co.id', 'alamat' => 'Jl. Gatot Subroto No.52, Jakarta'],
            ['nama_industri' => 'Indosat Ooredoo', 'website' => 'https://www.indosatooredoo.com', 'alamat' => 'Jl. Medan Merdeka Barat No.21, Jakarta'],
            ['nama_industri' => 'XL Axiata', 'website' => 'https://www.xl.co.id', 'alamat' => 'Jl. H.R. Rasuna Said, Jakarta'],
            ['nama_industri' => 'Accenture', 'website' => 'https://www.accenture.com/id-en', 'alamat' => 'Wisma 46, Jakarta'],
            ['nama_industri' => 'IBM Indonesia', 'website' => 'https://www.ibm.com/id-en', 'alamat' => 'Jl. Jend. Sudirman No.52-53, Jakarta'],
            ['nama_industri' => 'Deloitte', 'website' => 'https://www2.deloitte.com/id', 'alamat' => 'Menara Mulia, Jakarta'],
            ['nama_industri' => 'Bank Mandiri', 'website' => 'https://www.bankmandiri.co.id', 'alamat' => 'Jl. Jenderal Gatot Subroto No.36, Jakarta'],
            ['nama_industri' => 'Bank BCA', 'website' => 'https://www.bca.co.id', 'alamat' => 'Grand Indonesia, Jakarta'],
            ['nama_industri' => 'Bank Negara Indonesia', 'website' => 'https://www.bni.co.id', 'alamat' => 'Jl. Jenderal Sudirman No.1, Jakarta'],
            ['nama_industri' => 'BSSN', 'website' => 'https://www.bssn.go.id', 'alamat' => 'Jl. Raya Lapan No.70, Bogor'],
            ['nama_industri' => 'Telkomsigma', 'website' => 'https://www.telkomsigma.co.id', 'alamat' => 'Jl. TB Simatupang No.39, Jakarta'],
            ['nama_industri' => 'Vaksincom', 'website' => 'https://www.vaksincom.com', 'alamat' => 'Jl. Kebon Jeruk No.21, Jakarta'],

            ['nama_industri' => 'RCTI', 'website' => 'https://www.rcti.tv', 'alamat' => 'Jl. Raya Kebon Jeruk No.20, Jakarta'],
            ['nama_industri' => 'Trans7', 'website' => 'https://www.trans7.co.id', 'alamat' => 'Jl. Kapten Tendean No.12, Jakarta'],
            ['nama_industri' => 'NET TV', 'website' => 'https://www.netmedia.co.id', 'alamat' => 'Jl. Kebon Jeruk No.5, Jakarta'],
            ['nama_industri' => 'Go-Tix', 'website' => 'https://www.gotix.id', 'alamat' => 'Jl. M.H. Thamrin No.10, Jakarta'],
            ['nama_industri' => 'Netflix Indonesia', 'website' => 'https://www.netflix.com/id', 'alamat' => 'Menara Thamrin, Jakarta'],
            ['nama_industri' => 'YouTube Content Creators', 'website' => 'https://www.youtube.com', 'alamat' => 'Jl. Rasuna Said No.19, Jakarta'],
            ['nama_industri' => 'Studio Ghibli', 'website' => 'https://www.ghibli.jp', 'alamat' => 'Tokyo, Jepang'],
            ['nama_industri' => 'DreamWorks Animation', 'website' => 'https://www.dreamworks.com', 'alamat' => 'Glendale, California, USA'],
            ['nama_industri' => 'MNC Animation', 'website' => 'https://www.mncanimation.com', 'alamat' => 'Jakarta, Indonesia'],
            ['nama_industri' => 'Electronic Arts', 'website' => 'https://www.ea.com', 'alamat' => 'Redwood City, California, USA'],
            ['nama_industri' => 'Ubisoft', 'website' => 'https://www.ubisoft.com', 'alamat' => 'Montreuil, Prancis'],
            ['nama_industri' => 'Square Enix', 'website' => 'https://www.square-enix.com', 'alamat' => 'Tokyo, Jepang'],
            ['nama_industri' => 'Ogilvy Indonesia', 'website' => 'https://www.ogilvy.com', 'alamat' => 'Jakarta, Indonesia'],
            ['nama_industri' => 'Leo Burnett', 'website' => 'https://www.leoburnett.com', 'alamat' => 'Jakarta, Indonesia'],
            ['nama_industri' => 'VGI Global Media', 'website' => 'https://www.vgiglobalmedia.com', 'alamat' => 'Jakarta, Indonesia'],
            ['nama_industri' => 'SCTV', 'website' => 'https://www.sctv.co.id', 'alamat' => 'Jl. Daan Mogot No.10, Jakarta'],
            ['nama_industri' => 'Metro TV', 'website' => 'https://www.metrotvnews.com', 'alamat' => 'Jl. H.R. Rasuna Said, Jakarta'],
            ['nama_industri' => 'Kompas TV', 'website' => 'https://www.kompas.tv', 'alamat' => 'Jl. Palmerah Barat No.30, Jakarta'],

            ['nama_industri' => 'PT. FiberStar', 'website' => 'https://www.fiberstar.co.id', 'alamat' => 'Jl. Raya Serpong No.10, Tangerang'],
            ['nama_industri' => 'PT. Telekomunikasi Indonesia', 'website' => 'https://www.telkom.co.id', 'alamat' => 'Jl. Gatot Subroto No.52, Jakarta'],
            ['nama_industri' => 'Smartfren', 'website' => 'https://www.smartfren.com', 'alamat' => 'Jl. Raya Kebayoran Lama No.18, Jakarta'],
            ['nama_industri' => '3 (Tri) Indonesia', 'website' => 'https://www.tri.co.id', 'alamat' => 'Jl. Kebon Sirih No.33, Jakarta'],

            ['nama_industri' => 'PT. LG Electronics Indonesia', 'website' => 'https://www.lg.com/id', 'alamat' => 'Jakarta, Indonesia'],
            ['nama_industri' => 'PT. Samsung Electronics Indonesia', 'website' => 'https://www.samsung.com/id', 'alamat' => 'Jakarta, Indonesia'],
            ['nama_industri' => 'PT. Indofood Sukses Makmur', 'website' => 'https://www.indofood.com', 'alamat' => 'Jakarta, Indonesia'],
            ['nama_industri' => 'PT. Nestlé Indonesia', 'website' => 'https://www.nestle.co.id', 'alamat' => 'Jakarta, Indonesia'],
            ['nama_industri' => 'PT. Wijaya Karya', 'website' => 'https://www.wika.co.id', 'alamat' => 'Jakarta, Indonesia'],
            ['nama_industri' => 'PT. Total Bangun Persada', 'website' => 'https://www.totalbp.com', 'alamat' => 'Jakarta, Indonesia'],
            ['nama_industri' => 'PT. Lippo Karawaci', 'website' => 'https://www.lippokarawaci.co.id', 'alamat' => 'Jakarta, Indonesia'],
            ['nama_industri' => 'PT. Ciputra Development', 'website' => 'https://www.ciputra.com', 'alamat' => 'Jakarta, Indonesia'],

            ['nama_industri' => 'IKEA Indonesia', 'website' => 'https://www.ikea.co.id', 'alamat' => 'Jakarta, Indonesia'],
            ['nama_industri' => 'Informa', 'website' => 'https://www.informa.co.id', 'alamat' => 'Jakarta, Indonesia'],
            ['nama_industri' => 'PT. Airmas Asri', 'website' => 'https://www.airmasasri.co.id', 'alamat' => 'Jakarta, Indonesia'],
            ['nama_industri' => 'PT. Urban+ Indonesia', 'website' => 'https://www.urbanplus.co.id', 'alamat' => 'Jakarta, Indonesia'],
            ['nama_industri' => 'Matahari Department Store', 'website' => 'https://www.matahari.com', 'alamat' => 'Jakarta, Indonesia'],
            ['nama_industri' => 'PT. Ramayana Lestari Sentosa', 'website' => 'https://www.ramayana.co.id', 'alamat' => 'Jakarta, Indonesia'],

            ['nama_industri' => 'PT. Securindo Packatama Indonesia', 'website' => 'https://www.securindo.co.id', 'alamat' => 'Jakarta, Indonesia'],
            ['nama_industri' => 'PT. Garda Utama Indonesia', 'website' => 'https://www.gardautama.co.id', 'alamat' => 'Jakarta, Indonesia'],
            ['nama_industri' => 'PT. Pembangunan Perumahan', 'website' => 'https://www.pp.co.id', 'alamat' => 'Jakarta, Indonesia'],
        ];
        foreach ($industriList as $industri) {
            Industri::create($industri);
        }

        $industriProfesiMap = [
            'Astra Daihatsu Motor' => ['Teknisi Otomotif', 'Operator Mesin Industri', 'Teknisi Listrik Otomotif', 'Teknisi Diagnosa Mesin'],
            'Auto2000' => ['Teknisi Otomotif', 'Teknisi Diagnosa Mesin'],
            'Toyota Motor Manufacturing Indonesia' => ['Operator Mesin Industri'],
            'PT. Suzuki Indomobil Motor' => ['Operator Mesin Industri'],
            'Honda Prospect Motor' => ['Teknisi Listrik Otomotif'],
            'Mitsubishi Motors Krama Yudha Sales Indonesia' => ['Teknisi Listrik Otomotif'],
            'Yamaha Indonesia Motor Manufacturing' => ['Mekanik Motor'],
            'PT. Astra Honda Motor' => ['Mekanik Motor'],
            'PO Haryanto' => ['Montir Truk dan Bus'],
            'PO Sumber Alam' => ['Montir Truk dan Bus'],
            'BMW Astra' => ['Teknisi Diagnosa Mesin'],
            'Nissan-Datsun Indonesia' => ['Teknisi Diagnosa Mesin'],
            'Gojek' => ['Programmer'],
            'Tokopedia' => ['Programmer', 'Web Developer'],
            'Bukalapak' => ['Programmer', 'Web Developer'],
            'Traveloka' => ['Web Developer'],
            'Katalon' => ['Web Developer'],
            'Telkom Indonesia' => ['Network Engineer', 'Teknisi Telekomunikasi', 'Network Installer'],
            'Indosat Ooredoo' => ['Network Engineer', 'Teknisi Telekomunikasi', 'Network Installer', 'Operator BTS', 'Telecom Technician', 'Satellite Technician'],
            'XL Axiata' => ['Network Engineer', 'Teknisi Telekomunikasi', 'Network Installer'],
            'Accenture' => ['System Analyst'],
            'IBM Indonesia' => ['System Analyst'],
            'Deloitte' => ['System Analyst'],
            'Bank Mandiri' => ['Database Administrator'],
            'Bank BCA' => ['Database Administrator'],
            'Bank Negara Indonesia' => ['Database Administrator'],
            'BSSN' => ['Cybersecurity Analyst'],
            'Telkomsigma' => ['Cybersecurity Analyst'],
            'Vaksincom' => ['Cybersecurity Analyst'],
            'RCTI' => ['Teknisi Audio Visual', 'Broadcast Technician'],
            'Trans7' => ['Teknisi Audio Visual', 'Broadcast Technician'],
            'NET TV' => ['Teknisi Audio Visual', 'Broadcast Technician'],
            'Go-Tix' => ['Video Editor'],
            'Netflix Indonesia' => ['Video Editor'],
            'YouTube Content Creators' => ['Video Editor'],
            'Studio Ghibli' => ['Animator'],
            'DreamWorks Animation' => ['Animator'],
            'MNC Animation' => ['Animator'],
            'Electronic Arts' => ['Sound Designer'],
            'Ubisoft' => ['Sound Designer'],
            'Square Enix' => ['Sound Designer'],
            'Ogilvy Indonesia' => ['Motion Graphics Designer', 'Desainer Grafis', 'Ilustrator', 'Motion Designer', 'Visual Storyteller'],
            'Leo Burnett' => ['Motion Graphics Designer', 'Desainer Grafis', 'Ilustrator', 'Motion Designer', 'Visual Storyteller'],
            'VGI Global Media' => ['Motion Graphics Designer', 'Desainer Grafis', 'Ilustrator', 'Motion Designer', 'Visual Storyteller'],
            'SCTV' => ['Broadcast Technician'],
            'Metro TV' => ['Broadcast Technician'],
            'Kompas TV' => ['Broadcast Technician'],
            'PT. FiberStar' => ['Teknisi Fiber Optik'],
            'PT. Telekomunikasi Indonesia' => ['Teknisi Fiber Optik', 'Telecom Technician', 'Teknisi Telekomunikasi'],
            'Smartfren' => ['Operator BTS'],
            '3 (Tri) Indonesia' => ['Operator BTS'],
            'PT. LG Electronics Indonesia' => ['Teknisi Pendingin'],
            'PT. Samsung Electronics Indonesia' => ['Teknisi Pendingin'],
            'PT. Indofood Sukses Makmur' => ['Teknisi Refrigerasi', 'Teknisi Kulkas Industri'],
            'PT. Nestlé Indonesia' => ['Teknisi Refrigerasi', 'Teknisi Kulkas Industri'],
            'PT. Wijaya Karya' => ['Instalasi HVAC', 'Teknisi Ventilasi', 'Desainer Interior', 'Project Architect', '3D Visualizer', 'Teknisi Listrik Gedung'],
            'PT. Total Bangun Persada' => ['Instalasi HVAC', 'Teknisi Ventilasi', 'Desainer Interior', '3D Visualizer', 'Teknisi Listrik Gedung'],
            'PT. Lippo Karawaci' => ['Maintenance AC Gedung', 'Pengelola Gedung', 'Cleaning Service Manager'],
            'PT. Ciputra Development' => ['Maintenance AC Gedung', 'Pengelola Gedung', 'Cleaning Service Manager'],
            'IKEA Indonesia' => ['Desainer Furniture'],
            'Informa' => ['Desainer Furniture'],
            'PT. Airmas Asri' => ['Arsitek'],
            'PT. Urban+ Indonesia' => ['Arsitek'],
            'Matahari Department Store' => ['Desainer Retail'],
            'PT. Ramayana Lestari Sentosa' => ['Desainer Retail'],
            'PT. Securindo Packatama Indonesia' => ['Satpam'],
            'PT. Garda Utama Indonesia' => ['Satpam'],
            'PT. Pembangunan Perumahan' => ['Teknisi Bangunan', 'Surveyor', 'Geomatik', 'Teknisi Pemetaan', 'Cartographer', 'Project Architect'],
        ];
        foreach ($industriProfesiMap as $industriName => $profesiNames) {
            $industri = Industri::where('nama_industri', $industriName)->first();
            if (!$industri) continue;

            $profesiIds = ProfesiKerja::whereIn('nama_profesi_kerja', $profesiNames)->pluck('id')->toArray();

            $industri->profesiKerjas()->syncWithoutDetaching($profesiIds);
        }

        // Kategori Minat (RIASEC)
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

        // Relasi kategori minat (RIASEC) ke profesi
        $kategoriProfesiMap = [
            'Realistic' => [
                'Teknisi Otomotif', 'Operator Mesin Industri', 'Teknisi Listrik Otomotif', 'Mekanik Motor',
                'Montir Truk dan Bus', 'Teknisi Diagnosa Mesin', 'Teknisi Pendingin', 'Teknisi Refrigerasi',
                'Instalasi HVAC', 'Maintenance AC Gedung', 'Teknisi Kulkas Industri', 'Teknisi Ventilasi',
                'Teknisi Fiber Optik', 'Operator BTS', 'Network Installer', 'Teknisi Bangunan', 'Teknisi Pemetaan',
                'Teknisi Listrik Gedung'
            ],
            'Investigative' => [
                'Programmer', 'Web Developer', 'Network Engineer', 'System Analyst', 'Database Administrator',
                'Cybersecurity Analyst', 'Remote Sensing Analyst', 'Cartographer', 'Geomatik', 'Surveyor'
            ],
            'Artistic' => [
                'Teknisi Audio Visual', 'Video Editor', 'Animator', 'Sound Designer', 'Motion Graphics Designer',
                'Desainer Grafis', 'Ilustrator', 'Motion Designer', 'Visual Storyteller', 'Desainer Interior',
                '3D Visualizer', 'Desainer Retail', 'Desainer Furniture', 'Project Architect', 'Arsitek'
            ],
            'Social' => [
                'Satpam', 'Pengelola Gedung', 'Cleaning Service Manager'
            ],
            'Enterprising' => [
                'Project Architect', 'Database Administrator', 'System Analyst'
            ],
            'Conventional' => [
                'Database Administrator', 'Pengelola Gedung', 'Cleaning Service Manager'
            ]
        ];
        foreach ($kategoriProfesiMap as $kategoriName => $profesiNames) {
            $kategori = KategoriMinat::where('nama_kategori', $kategoriName)->first();
            if (!$kategori) continue;

            $profesiIds = ProfesiKerja::whereIn('nama_profesi_kerja', $profesiNames)->pluck('id')->toArray();

            $kategori->profesiKerjas()->syncWithoutDetaching($profesiIds);
        }

         // 🔹 Materi sekolah sesuai jurusan
        $dataTopikJurusan = [
            'SIJA' => [
                [
                    'judul_topik' => 'Pemrograman Web Dasar',
                    'materi' => [
                        ['nama_materi' => 'HTML & CSS', 'deskripsi_materi' => 'Dasar struktur web dengan HTML dan styling dengan CSS'],
                        ['nama_materi' => 'JavaScript Fundamental', 'deskripsi_materi' => 'Dasar pemrograman interaktif di web'],
                    ],
                ],
                [
                    'judul_topik' => 'Jaringan Komputer',
                    'materi' => [
                        ['nama_materi' => 'Dasar Jaringan', 'deskripsi_materi' => 'IP Address, subnetting, perangkat jaringan'],
                        ['nama_materi' => 'Konfigurasi Router', 'deskripsi_materi' => 'Setup RouterOS / Cisco untuk jaringan sekolah'],
                    ],
                ],
            ],
            'TKR' => [
                [
                    'judul_topik' => 'Perawatan Mesin',
                    'materi' => [
                        ['nama_materi' => 'Sistem Bahan Bakar', 'deskripsi_materi' => 'Injeksi, karburator, dan perawatan mesin'],
                        ['nama_materi' => 'Diagnosa Mesin', 'deskripsi_materi' => 'Menggunakan scanner untuk analisis kerusakan'],
                    ],
                ],
            ],
            'TAV' => [
                [
                    'judul_topik' => 'Elektronika Dasar',
                    'materi' => [
                        ['nama_materi' => 'Komponen Elektronika', 'deskripsi_materi' => 'Resistor, kapasitor, transistor'],
                        ['nama_materi' => 'Rangkaian Seri & Paralel', 'deskripsi_materi' => 'Analisis dasar rangkaian listrik'],
                    ],
                ],
                [
                    'judul_topik' => 'Sistem Audio Video',
                    'materi' => [
                        ['nama_materi' => 'Instalasi Sound System', 'deskripsi_materi' => 'Teknik pemasangan dan konfigurasi audio'],
                        ['nama_materi' => 'Teknologi Televisi', 'deskripsi_materi' => 'Cara kerja dan troubleshooting TV'],
                    ],
                ],
            ],
            'TITL' => [
                [
                    'judul_topik' => 'Instalasi Listrik',
                    'materi' => [
                        ['nama_materi' => 'Pemasangan Instalasi Rumah', 'deskripsi_materi' => 'Dasar pemasangan instalasi listrik rumah'],
                        ['nama_materi' => 'Keselamatan Listrik', 'deskripsi_materi' => 'Prosedur K3 dalam instalasi listrik'],
                    ],
                ],
            ],
            'TP' => [
                [
                    'judul_topik' => 'Teknik Pengelasan',
                    'materi' => [
                        ['nama_materi' => 'Las Listrik SMAW', 'deskripsi_materi' => 'Dasar pengelasan busur listrik'],
                        ['nama_materi' => 'Las MIG & TIG', 'deskripsi_materi' => 'Teknik modern dalam pengelasan logam'],
                    ],
                ],
            ],
            'DPIB' => [
                [
                    'judul_topik' => 'Gambar Teknik Bangunan',
                    'materi' => [
                        ['nama_materi' => 'AutoCAD Dasar', 'deskripsi_materi' => 'Membuat gambar teknik dengan AutoCAD'],
                        ['nama_materi' => 'Denah & Potongan Bangunan', 'deskripsi_materi' => 'Membaca & membuat denah arsitektur'],
                    ],
                ],
            ],
            'KGSP' => [
                [
                    'judul_topik' => 'Desain Interior & Eksterior',
                    'materi' => [
                        ['nama_materi' => 'SketchUp Dasar', 'deskripsi_materi' => 'Membuat desain 3D rumah sederhana'],
                        ['nama_materi' => 'Teknik Rendering', 'deskripsi_materi' => 'Membuat visual realistis bangunan'],
                    ],
                ],
            ],
            'DKV' => [
                [
                    'judul_topik' => 'Desain Grafis',
                    'materi' => [
                        ['nama_materi' => 'Adobe Photoshop', 'deskripsi_materi' => 'Editing & manipulasi gambar'],
                        ['nama_materi' => 'Adobe Illustrator', 'deskripsi_materi' => 'Desain vektor untuk logo & ilustrasi'],
                    ],
                ],
            ],
            'GEO' => [
                [
                    'judul_topik' => 'Geologi Dasar',
                    'materi' => [
                        ['nama_materi' => 'Struktur Bumi', 'deskripsi_materi' => 'Lapisan bumi dan sifat-sifatnya'],
                        ['nama_materi' => 'Peta & Survey', 'deskripsi_materi' => 'Dasar pemetaan dan survey geologi'],
                    ],
                ],
                [
                    'judul_topik' => 'Pertambangan',
                    'materi' => [
                        ['nama_materi' => 'Teknik Eksplorasi', 'deskripsi_materi' => 'Metode eksplorasi mineral'],
                        ['nama_materi' => 'Keselamatan Tambang', 'deskripsi_materi' => 'K3 dalam dunia pertambangan'],
                    ],
                ],
            ],
        ];

        // 🔹 Materi umum berdasarkan rencana (kerja / kuliah)
        $dataTopikRencana = [
            'Kuliah' => [
                [
                    'judul_topik' => 'Persiapan Kuliah',
                    'materi' => [
                        ['nama_materi' => 'Mengenal Jalur Masuk Perguruan Tinggi', 'deskripsi_materi' => 'SNBP, SNBT, Mandiri, dan beasiswa'],
                        ['nama_materi' => 'Strategi Belajar UTBK', 'deskripsi_materi' => 'Tips menguasai materi tes dan manajemen waktu'],
                        ['nama_materi' => 'Soft Skill Mahasiswa Baru', 'deskripsi_materi' => 'Public speaking, organisasi, manajemen waktu'],
                    ],
                ],
                [
                    'judul_topik' => 'Tips Kehidupan Kampus',
                    'materi' => [
                        ['nama_materi' => 'Manajemen Keuangan Mahasiswa', 'deskripsi_materi' => 'Cara mengatur uang saku dan beasiswa'],
                        ['nama_materi' => 'Networking & Relasi', 'deskripsi_materi' => 'Pentingnya ikut komunitas dan membangun relasi'],
                    ],
                ],
            ],
            'Kerja' => [
                [
                    'judul_topik' => 'Persiapan Dunia Kerja',
                    'materi' => [
                        ['nama_materi' => 'Membuat CV & Portofolio', 'deskripsi_materi' => 'Panduan membuat CV ATS-friendly dan portofolio digital'],
                        ['nama_materi' => 'Etika & Sikap Profesional', 'deskripsi_materi' => 'Sopan santun, disiplin, komunikasi di tempat kerja'],
                        ['nama_materi' => 'Skill yang Dibutuhkan Industri', 'deskripsi_materi' => 'Problem solving, teamwork, critical thinking'],
                    ],
                ],
                [
                    'judul_topik' => 'Tips Menghadapi Rekrutmen',
                    'materi' => [
                        ['nama_materi' => 'Simulasi Wawancara Kerja', 'deskripsi_materi' => 'Latihan tanya jawab HR & user interview'],
                        ['nama_materi' => 'Psikotes & Tes Online', 'deskripsi_materi' => 'Cara menghadapi tes logika, kepribadian, dan teknis'],
                        ['nama_materi' => 'LinkedIn & Networking', 'deskripsi_materi' => 'Membangun personal branding untuk karier'],
                    ],
                ],
            ],
        ];

        // 🔹 Aturan kelas & jurusan
        $jurusanAll = ['TKR', 'SIJA', 'TAV', 'TITL', 'TP', 'DPIB', 'KGSP', 'DKV', 'GEO'];

        foreach (Kelas::all() as $kelas) {
            foreach (Rencana::all() as $rencana) {
                foreach ($jurusanAll as $jurusanName) {
                    // Skip kelas XIII kecuali SIJA & KGSP
                    if ($kelas->nama_kelas == 'XIII' && !in_array($jurusanName, ['SIJA', 'KGSP'])) {
                        continue;
                    }

                    $jurusan = Jurusan::where('nama_jurusan', $jurusanName)->first();
                    if (!$jurusan) continue;

                    // --- Materi khusus jurusan
                    if (isset($dataTopikJurusan[$jurusanName])) {
                        foreach ($dataTopikJurusan[$jurusanName] as $topikData) {
                            $topik = TopikMateri::create([
                                'judul_topik' => $topikData['judul_topik'],
                                'kelas_id' => $kelas->id,
                                'jurusan_id' => $jurusan->id,
                                'rencana_id' => $rencana->id,
                            ]);

                            foreach ($topikData['materi'] as $materiData) {
                                Materi::create([
                                    'topik_materi_id' => $topik->id,
                                    'nama_materi' => $materiData['nama_materi'],
                                    'deskripsi_materi' => $materiData['deskripsi_materi'],
                                    'tipe_file' => null,
                                    'file_materi' => null,
                                ]);
                            }
                        }
                    }

                    // --- Materi umum rencana (kuliah/kerja)
                    if (isset($dataTopikRencana[$rencana->nama_rencana])) {
                        foreach ($dataTopikRencana[$rencana->nama_rencana] as $topikData) {
                            $topik = TopikMateri::create([
                                'judul_topik' => $topikData['judul_topik'],
                                'kelas_id' => $kelas->id,
                                'jurusan_id' => $jurusan->id,
                                'rencana_id' => $rencana->id,
                            ]);

                            foreach ($topikData['materi'] as $materiData) {
                                Materi::create([
                                    'topik_materi_id' => $topik->id,
                                    'nama_materi' => $materiData['nama_materi'],
                                    'deskripsi_materi' => $materiData['deskripsi_materi'],
                                    'tipe_file' => null,
                                    'file_materi' => null,
                                ]);
                            }
                        }
                    }
                }
            }
        }

        // Tes utama
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
            ['soal_tes_id' => $soal1->id, 'kategori_minat_id' => 4, 'profesi_kerja_id' => null, 'isi_opsi' => 'Membantu orang lain atau mengajar', 'poin' => 5],
            ['soal_tes_id' => $soal1->id, 'kategori_minat_id' => 3, 'profesi_kerja_id' => null, 'isi_opsi' => 'Menggambar, melukis, atau desain', 'poin' => 5],
            ['soal_tes_id' => $soal1->id, 'kategori_minat_id' => 6, 'profesi_kerja_id' => null, 'isi_opsi' => 'Mengatur data atau dokumen', 'poin' => 5],
            ['soal_tes_id' => $soal1->id, 'kategori_minat_id' => 2, 'profesi_kerja_id' => null, 'isi_opsi' => 'Melakukan eksperimen atau penelitian', 'poin' => 5],
            ['soal_tes_id' => $soal1->id, 'kategori_minat_id' => 1, 'profesi_kerja_id' => null, 'isi_opsi' => 'Memperbaiki atau merakit mesin', 'poin' => 5],
            ['soal_tes_id' => $soal1->id, 'kategori_minat_id' => 5, 'profesi_kerja_id' => null, 'isi_opsi' => 'Mengelola tim atau berbisnis', 'poin' => 5],
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
            ['soal_tes_id' => $soal2->id, 'kategori_minat_id' => 2, 'profesi_kerja_id' => null, 'isi_opsi' => 'Menganalisis masalah dan mencari solusi', 'poin' => 5],
            ['soal_tes_id' => $soal2->id, 'kategori_minat_id' => 1, 'profesi_kerja_id' => null, 'isi_opsi' => 'Bertugas memegang alat dan praktek langsung', 'poin' => 5],
            ['soal_tes_id' => $soal2->id, 'kategori_minat_id' => 3, 'profesi_kerja_id' => null, 'isi_opsi' => 'Membuat presentasi atau desain tampilan', 'poin' => 5],
            ['soal_tes_id' => $soal2->id, 'kategori_minat_id' => 6, 'profesi_kerja_id' => null, 'isi_opsi' => 'Mendata hasil kerja dan membuat laporan', 'poin' => 5],
            ['soal_tes_id' => $soal2->id, 'kategori_minat_id' => 5, 'profesi_kerja_id' => null, 'isi_opsi' => 'Mengatur strategi kelompok agar lebih terarah', 'poin' => 5],
            ['soal_tes_id' => $soal2->id, 'kategori_minat_id' => 4, 'profesi_kerja_id' => null, 'isi_opsi' => 'Menjadi penengah dan membantu teman yang kesulitan', 'poin' => 5],
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
            ['soal_tes_id' => $soal3->id, 'kategori_minat_id' => 4, 'profesi_kerja_id' => null, 'isi_opsi' => 'Mengajar adik/teman, ikut kegiatan sosial', 'poin' => 5],
            ['soal_tes_id' => $soal3->id, 'kategori_minat_id' => 1, 'profesi_kerja_id' => null, 'isi_opsi' => 'Merakit atau memperbaiki barang', 'poin' => 5],
            ['soal_tes_id' => $soal3->id, 'kategori_minat_id' => 5, 'profesi_kerja_id' => null, 'isi_opsi' => 'Berjualan online atau ikut organisasi', 'poin' => 5],
            ['soal_tes_id' => $soal3->id, 'kategori_minat_id' => 2, 'profesi_kerja_id' => null, 'isi_opsi' => 'Membaca buku atau artikel sains/teknologi', 'poin' => 5],
            ['soal_tes_id' => $soal3->id, 'kategori_minat_id' => 6, 'profesi_kerja_id' => null, 'isi_opsi' => 'Merapikan data, dokumen, atau koleksi pribadi', 'poin' => 5],
            ['soal_tes_id' => $soal3->id, 'kategori_minat_id' => 3, 'profesi_kerja_id' => null, 'isi_opsi' => 'Menggambar, membuat video, atau desain digital', 'poin' => 5],
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
            ['soal_tes_id' => $soal4->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 1, 'isi_opsi' => 'Servis kendaraan ringan', 'poin' => 15],
            ['soal_tes_id' => $soal4->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 3, 'isi_opsi' => 'Perbaikan kelistrikan mobil', 'poin' => 15],
            ['soal_tes_id' => $soal4->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 5, 'isi_opsi' => 'Perawatan mesin berat', 'poin' => 15],
            ['soal_tes_id' => $soal4->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 6, 'isi_opsi' => 'Diagnosa kerusakan mesin', 'poin' => 15],
            ['soal_tes_id' => $soal4->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 14, 'isi_opsi' => 'Editing video profesional', 'poin' => 15],
            ['soal_tes_id' => $soal4->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 15, 'isi_opsi' => 'Desain motion graphic', 'poin' => 15],
            ['soal_tes_id' => $soal4->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 21, 'isi_opsi' => 'Pemantauan jaringan BTS', 'poin' => 15],
            ['soal_tes_id' => $soal4->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 22, 'isi_opsi' => 'Instalasi jaringan internet', 'poin' => 15],
            ['soal_tes_id' => $soal4->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 23, 'isi_opsi' => 'Perbaikan alat komunikasi', 'poin' => 15],
            ['soal_tes_id' => $soal4->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 37, 'isi_opsi' => 'Pengelolaan operasional gedung', 'poin' => 15],
            ['soal_tes_id' => $soal4->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 38, 'isi_opsi' => 'Perawatan fasilitas gedung', 'poin' => 15],
            ['soal_tes_id' => $soal4->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 40, 'isi_opsi' => 'Pengelolaan sistem sanitasi', 'poin' => 15],
            ['soal_tes_id' => $soal4->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 41, 'isi_opsi' => 'Pemasangan instalasi gedung', 'poin' => 15],
            ['soal_tes_id' => $soal4->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 44, 'isi_opsi' => 'Pembuatan animasi 2D/3D', 'poin' => 15],
            ['soal_tes_id' => $soal4->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 47, 'isi_opsi' => 'Pengukuran dan pemetaan', 'poin' => 15],
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
            ['soal_tes_id' => $soal5->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 4, 'isi_opsi' => 'Kerja teknis lapangan', 'poin' => 15],
            ['soal_tes_id' => $soal5->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 8, 'isi_opsi' => 'Kerja kreatif digital', 'poin' => 15],
            ['soal_tes_id' => $soal5->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 9, 'isi_opsi' => 'Analisis dan konfigurasi', 'poin' => 15],
            ['soal_tes_id' => $soal5->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 10, 'isi_opsi' => 'Analisis kebutuhan sistem', 'poin' => 15],
            ['soal_tes_id' => $soal5->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 12, 'isi_opsi' => 'Pemantauan keamanan data', 'poin' => 15],
            ['soal_tes_id' => $soal5->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 18, 'isi_opsi' => 'Kerja teknis studio', 'poin' => 15],
            ['soal_tes_id' => $soal5->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 24, 'isi_opsi' => 'Instalasi perangkat satelit', 'poin' => 15],
            ['soal_tes_id' => $soal5->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 25, 'isi_opsi' => 'Pengoperasian mesin bubut', 'poin' => 15],
            ['soal_tes_id' => $soal5->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 27, 'isi_opsi' => 'Kerja produksi pabrik', 'poin' => 15],
            ['soal_tes_id' => $soal5->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 31, 'isi_opsi' => 'Desain ruang interior', 'poin' => 15],
            ['soal_tes_id' => $soal5->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 32, 'isi_opsi' => 'Perancangan bangunan estetis', 'poin' => 15],
            ['soal_tes_id' => $soal5->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 33, 'isi_opsi' => 'Desain furnitur fungsional', 'poin' => 15],
            ['soal_tes_id' => $soal5->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 35, 'isi_opsi' => 'Visualisasi desain 3D', 'poin' => 15],
            ['soal_tes_id' => $soal5->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 42, 'isi_opsi' => 'Desain grafis kreatif', 'poin' => 15],
            ['soal_tes_id' => $soal5->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 45, 'isi_opsi' => 'Desain motion animasi', 'poin' => 15],
            ['soal_tes_id' => $soal5->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 50, 'isi_opsi' => 'Pemetaan data geografis', 'poin' => 15],
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
            ['soal_tes_id' => $soal6->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 2, 'isi_opsi' => 'Operator Industri', 'poin' => 15],
            ['soal_tes_id' => $soal6->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 7, 'isi_opsi' => 'Programmer', 'poin' => 15],
            ['soal_tes_id' => $soal6->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 11, 'isi_opsi' => 'Database Admin', 'poin' => 15],
            ['soal_tes_id' => $soal6->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 13, 'isi_opsi' => 'Teknisi Audio Visual', 'poin' => 15],
            ['soal_tes_id' => $soal6->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 16, 'isi_opsi' => 'Sound Designer', 'poin' => 15],
            ['soal_tes_id' => $soal6->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 17, 'isi_opsi' => 'Motion Designer', 'poin' => 15],
            ['soal_tes_id' => $soal6->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 19, 'isi_opsi' => 'Teknisi Telekomunikasi', 'poin' => 15],
            ['soal_tes_id' => $soal6->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 26, 'isi_opsi' => 'Operator CNC', 'poin' => 15],
            ['soal_tes_id' => $soal6->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 28, 'isi_opsi' => 'Teknisi Mesin Industri', 'poin' => 15],
            ['soal_tes_id' => $soal6->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 29, 'isi_opsi' => 'Quality Control', 'poin' => 15],
            ['soal_tes_id' => $soal6->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 30, 'isi_opsi' => 'Drafter Mesin', 'poin' => 15],
            ['soal_tes_id' => $soal6->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 34, 'isi_opsi' => 'Project Architect', 'poin' => 15],
            ['soal_tes_id' => $soal6->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 36, 'isi_opsi' => 'Desainer Retail', 'poin' => 15],
            ['soal_tes_id' => $soal6->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 39, 'isi_opsi' => 'Supervisor Gedung', 'poin' => 15],
            ['soal_tes_id' => $soal6->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 51, 'isi_opsi' => 'Analisis Remote Sensing', 'poin' => 15],
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
            ['soal_tes_id' => $soal7->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 3, 'isi_opsi' => 'Memasang sistem kelistrikan', 'poin' => 15],
            ['soal_tes_id' => $soal7->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 6, 'isi_opsi' => 'Menganalisis performa mesin', 'poin' => 15],
            ['soal_tes_id' => $soal7->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 10, 'isi_opsi' => 'Menganalisis kebutuhan sistem', 'poin' => 15],
            ['soal_tes_id' => $soal7->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 24, 'isi_opsi' => 'Memasang perangkat satelit', 'poin' => 15],
            ['soal_tes_id' => $soal7->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 37, 'isi_opsi' => 'Mengatur operasional gedung', 'poin' => 15],
            ['soal_tes_id' => $soal7->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 42, 'isi_opsi' => 'Membuat desain visual', 'poin' => 15],
            ['soal_tes_id' => $soal7->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 5, 'isi_opsi' => 'Memperbaiki kendaraan berat', 'poin' => 15],
            ['soal_tes_id' => $soal7->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 14, 'isi_opsi' => 'Menyunting video kreatif', 'poin' => 15],
            ['soal_tes_id' => $soal7->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 15, 'isi_opsi' => 'Membuat animasi gerak', 'poin' => 15],
            ['soal_tes_id' => $soal7->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 41, 'isi_opsi' => 'Menginstal sistem bangunan', 'poin' => 15],
            ['soal_tes_id' => $soal7->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 23, 'isi_opsi' => 'Memelihara jaringan telekom', 'poin' => 15],
            ['soal_tes_id' => $soal7->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 38, 'isi_opsi' => 'Memelihara fasilitas gedung', 'poin' => 15],
            ['soal_tes_id' => $soal7->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 44, 'isi_opsi' => 'Menggambar karakter animasi', 'poin' => 15],
            ['soal_tes_id' => $soal7->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 47, 'isi_opsi' => 'Mengukur data lapangan', 'poin' => 15],
            ['soal_tes_id' => $soal7->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 21, 'isi_opsi' => 'Mengoperasikan perangkat BTS', 'poin' => 15],
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
            ['soal_tes_id' => $soal8->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 1, 'isi_opsi' => 'Memperbaiki kendaraan bermotor', 'poin' => 15],
            ['soal_tes_id' => $soal8->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 8, 'isi_opsi' => 'Membuat tampilan web', 'poin' => 15],
            ['soal_tes_id' => $soal8->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 13, 'isi_opsi' => 'Mengatur sistem audio', 'poin' => 15],
            ['soal_tes_id' => $soal8->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 27, 'isi_opsi' => 'Mengoperasikan mesin produksi', 'poin' => 15],
            ['soal_tes_id' => $soal8->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 32, 'isi_opsi' => 'Merancang bangunan estetik', 'poin' => 15],
            ['soal_tes_id' => $soal8->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 35, 'isi_opsi' => 'Membuat visual 3D', 'poin' => 15],
            ['soal_tes_id' => $soal8->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 36, 'isi_opsi' => 'Mendesain tata retail', 'poin' => 15],
            ['soal_tes_id' => $soal8->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 39, 'isi_opsi' => 'Mengawasi proyek konstruksi', 'poin' => 15],
            ['soal_tes_id' => $soal8->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 40, 'isi_opsi' => 'Menjaga kebersihan bangunan', 'poin' => 15],
            ['soal_tes_id' => $soal8->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 28, 'isi_opsi' => 'Merawat mesin industri', 'poin' => 15],
            ['soal_tes_id' => $soal8->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 19, 'isi_opsi' => 'Mengelola sistem telekom', 'poin' => 15],
            ['soal_tes_id' => $soal8->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 11, 'isi_opsi' => 'Mengelola basis data', 'poin' => 15],
            ['soal_tes_id' => $soal8->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 16, 'isi_opsi' => 'Mencipta efek suara', 'poin' => 15],
            ['soal_tes_id' => $soal8->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 31, 'isi_opsi' => 'Mendesain ruang interior', 'poin' => 15],
            ['soal_tes_id' => $soal8->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 43, 'isi_opsi' => 'Menggambar ilustrasi kreatif', 'poin' => 15],
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
            ['soal_tes_id' => $soal9->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 2, 'isi_opsi' => 'Mengoperasikan Mesin Industri', 'poin' => 15],
            ['soal_tes_id' => $soal9->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 4, 'isi_opsi' => 'Servis dan Perbaikan Motor', 'poin' => 15],
            ['soal_tes_id' => $soal9->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 7, 'isi_opsi' => 'Menulis Kode Program', 'poin' => 15],
            ['soal_tes_id' => $soal9->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 9, 'isi_opsi' => 'Membangun Jaringan Komputer', 'poin' => 15],
            ['soal_tes_id' => $soal9->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 12, 'isi_opsi' => 'Melindungi Sistem Data', 'poin' => 15],
            ['soal_tes_id' => $soal9->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 18, 'isi_opsi' => 'Menyiarkan Acara TV/Radio', 'poin' => 15],
            ['soal_tes_id' => $soal9->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 20, 'isi_opsi' => 'Memasang Kabel Fiber Optik', 'poin' => 15],
            ['soal_tes_id' => $soal9->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 25, 'isi_opsi' => 'Mengoperasikan Mesin Bubut', 'poin' => 15],
            ['soal_tes_id' => $soal9->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 29, 'isi_opsi' => 'Memeriksa Kualitas Produk', 'poin' => 15],
            ['soal_tes_id' => $soal9->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 33, 'isi_opsi' => 'Merancang Furniture Interior', 'poin' => 15],
            ['soal_tes_id' => $soal9->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 30, 'isi_opsi' => 'Membuat Gambar Teknik Mesin', 'poin' => 15],
            ['soal_tes_id' => $soal9->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 45, 'isi_opsi' => 'Membuat Motion Graphic', 'poin' => 15],
            ['soal_tes_id' => $soal9->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 46, 'isi_opsi' => 'Menceritakan Visual Kreatif', 'poin' => 15],
            ['soal_tes_id' => $soal9->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 48, 'isi_opsi' => 'Menganalisis Data Geospasial', 'poin' => 15],
            ['soal_tes_id' => $soal9->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 49, 'isi_opsi' => 'Mengukur dan Memetakan Lahan', 'poin' => 15],
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
            ['soal_tes_id' => $soal10->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 5, 'isi_opsi' => 'Perawatan Kendaraan Berat', 'poin' => 15],
            ['soal_tes_id' => $soal10->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 11, 'isi_opsi' => 'Manajemen Basis Data', 'poin' => 15],
            ['soal_tes_id' => $soal10->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 17, 'isi_opsi' => 'Desain Motion Graphic', 'poin' => 15],
            ['soal_tes_id' => $soal10->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 19, 'isi_opsi' => 'Teknologi Telekomunikasi', 'poin' => 15],
            ['soal_tes_id' => $soal10->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 20, 'isi_opsi' => 'Instalasi Fiber Optik', 'poin' => 15],
            ['soal_tes_id' => $soal10->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 22, 'isi_opsi' => 'Instalasi Jaringan Kabel', 'poin' => 15],
            ['soal_tes_id' => $soal10->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 23, 'isi_opsi' => 'Sistem Komunikasi Data', 'poin' => 15],
            ['soal_tes_id' => $soal10->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 26, 'isi_opsi' => 'Pengoperasian Mesin CNC', 'poin' => 15],
            ['soal_tes_id' => $soal10->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 30, 'isi_opsi' => 'Gambar Teknik Mesin', 'poin' => 15],
            ['soal_tes_id' => $soal10->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 34, 'isi_opsi' => 'Perencanaan Proyek Arsitektur', 'poin' => 15],
            ['soal_tes_id' => $soal10->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 46, 'isi_opsi' => 'Penceritaan Visual Kreatif', 'poin' => 15],
            ['soal_tes_id' => $soal10->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 48, 'isi_opsi' => 'Analisis Data Geospasial', 'poin' => 15],
            ['soal_tes_id' => $soal10->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 49, 'isi_opsi' => 'Pemetaan dan Survey Lahan', 'poin' => 15],
            ['soal_tes_id' => $soal10->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 50, 'isi_opsi' => 'Pemetaan Kartografi Digital', 'poin' => 15],
            ['soal_tes_id' => $soal10->id, 'kategori_minat_id' => null, 'profesi_kerja_id' => 51, 'isi_opsi' => 'Analisis Citra Satelit', 'poin' => 15],
        ];
        foreach ($opsi10 as $data) {
            OpsiJawaban::create($data);
        }
    }
}
