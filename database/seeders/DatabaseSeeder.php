<?php

namespace Database\Seeders;

use App\Models\Tes;
use App\Models\Hobi;
use App\Models\Role;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Kampus;
use App\Models\Materi;
use App\Models\Jurusan;
use App\Models\Rencana;
use App\Models\SoalTes;
use App\Models\Industri;
use App\Models\OpsiJawaban;
use App\Models\TopikMateri;
use App\Models\ProfesiKerja;
use App\Models\JurusanKuliah;
use App\Models\KampusJurusan;
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

        // Industri
        $industriList = [
            ['nama_industri' => 'Astra Daihatsu Motor', 'website' => 'https://www.astradaihatsu.co.id', 'alamat' => 'Jl. Gaya Motor No.8, Sunter, Jakarta Utara'],
            ['nama_industri' => 'Auto2000', 'website' => 'https://www.auto2000.co.id', 'alamat' => 'Jl. Gunung Sahari No.18, Jakarta Pusat'],
            ['nama_industri' => 'Toyota Motor Manufacturing Indonesia', 'website' => 'https://www.toyota.co.id', 'alamat' => 'Jl. MT Haryono Kav.8, Jakarta'],
            ['nama_industri' => 'PT. Suzuki Indomobil Motor', 'website' => 'https://www.suzuki.co.id', 'alamat' => 'Jl. Raya Cakung Cilincing, Jakarta Timur'],
            ['nama_industri' => 'Honda Prospect Motor', 'website' => 'https://www.honda-indonesia.com', 'alamat' => 'Jl. Gaya Motor Raya No.1, Sunter, Jakarta Utara'],
            ['nama_industri' => 'Mitsubishi Motors', 'website' => 'https://www.mitsubishi-motors.co.id', 'alamat' => 'Jl. Raya Bogor KM.26, Jakarta Timur'],
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
            ['nama_industri' => 'PT. Securindo Packatama Indonesia', 'website' => 'https://www.securindo.co.id', 'alamat' => 'Jakarta, Indonesia'],
            ['nama_industri' => 'PT. Garda Utama Indonesia', 'website' => 'https://www.gardautama.co.id', 'alamat' => 'Jakarta, Indonesia'],
            ['nama_industri' => 'PT. Pembangunan Perumahan', 'website' => 'https://www.pp.co.id', 'alamat' => 'Jakarta, Indonesia'],
        ];
        foreach ($industriList as $industri) {
            Industri::create($industri);
        }

        // Industri Profesi Map New
        $industriProfesiMap = [
            'Astra Daihatsu Motor' => [
                ['profesi' => 'Teknisi Otomotif', 'gaji' => 5000000],
                ['profesi' => 'Teknisi Diagnosa Mesin', 'gaji' => 5200000],
            ],
            'Toyota Motor Manufacturing Indonesia' => [
                ['profesi' => 'Teknisi Otomotif', 'gaji' => 4800000],
                ['profesi' => 'Operator Mesin Industri', 'gaji' => 5000000],
                ['profesi' => 'Teknisi Listrik Otomotif', 'gaji' => 5200000],
                ['profesi' => 'Teknisi Diagnosa Mesin', 'gaji' => 5300000],

                ['profesi' => 'Operator Mesin Bubut', 'gaji' => 5000000],
                ['profesi' => 'Teknisi Produksi Manufaktur', 'gaji' => 5400000],
            ],
            'Honda Prospect Motor' => [
                ['profesi' => 'Teknisi Otomotif', 'gaji' => 5100000],
                ['profesi' => 'Teknisi Diagnosa Mesin', 'gaji' => 5200000],
            ],
            'Mitsubishi Motors' => [
                ['profesi' => 'Teknisi Otomotif', 'gaji' => 5000000],
                ['profesi' => 'Teknisi Kendaraan Berat', 'gaji' => 5500000],
            ],
            'PT. Suzuki Indomobil Motor' => [
                ['profesi' => 'Teknisi Otomotif', 'gaji' => 4900000],
                ['profesi' => 'Operator Mesin Industri', 'gaji' => 4900000],

                ['profesi' => 'Teknisi Perawatan Mesin Industri', 'gaji' => 5100000],
                ['profesi' => 'Quality Control Produk Mekanik', 'gaji' => 5200000],
            ],
            'Auto2000' => [
                ['profesi' => 'Teknisi Otomotif', 'gaji' => 5000000],
                ['profesi' => 'Mekanik Motor', 'gaji' => 4700000],

                ['profesi' => 'Mekanik Motor', 'gaji' => 4600000],
            ],
            'BMW Astra' => [
                ['profesi' => 'Teknisi Otomotif', 'gaji' => 5500000],
                ['profesi' => 'Teknisi Diagnosa Mesin', 'gaji' => 5600000],
            ],
            'PT. Astra Honda Motor' => [
                ['profesi' => 'Operator Mesin Industri', 'gaji' => 5000000],
                ['profesi' => 'Teknisi Listrik Otomotif', 'gaji' => 5200000],
                ['profesi' => 'Mekanik Motor', 'gaji' => 4800000],

                ['profesi' => 'Operator Mesin CNC', 'gaji' => 5200000],
                ['profesi' => 'Teknisi Produksi Manufaktur', 'gaji' => 5300000],
            ],
            'PT. Indofood Sukses Makmur' => [
                ['profesi' => 'Operator Mesin Industri', 'gaji' => 4900000],

                ['profesi' => 'Teknisi Perawatan Mesin Industri', 'gaji' => 4800000],
                ['profesi' => 'Operator Mesin CNC', 'gaji' => 4900000],
            ],
            'PT. Nestlé Indonesia' => [
                ['profesi' => 'Operator Mesin Industri', 'gaji' => 5000000],

                ['profesi' => 'Teknisi Produksi Manufaktur', 'gaji' => 5300000],
                ['profesi' => 'Quality Control Produk Mekanik', 'gaji' => 5200000],
            ],
            'Yamaha Indonesia Motor Manufacturing' => [
                ['profesi' => 'Teknisi Listrik Otomotif', 'gaji' => 5100000],
                ['profesi' => 'Mekanik Motor', 'gaji' => 4700000],
            ],
            'Nissan-Datsun Indonesia' => [
                ['profesi' => 'Teknisi Listrik Otomotif', 'gaji' => 5000000],
                ['profesi' => 'Teknisi Diagnosa Mesin', 'gaji' => 5200000],
            ],
            'PO Sumber Alam' => [
                ['profesi' => 'Mekanik Motor', 'gaji' => 4700000],
                ['profesi' => 'Teknisi Kendaraan Berat', 'gaji' => 5300000],
            ],
            'PO Haryanto' => [
                ['profesi' => 'Teknisi Kendaraan Berat', 'gaji' => 5400000],
            ],
            'PT. Wijaya Karya' => [
                ['profesi' => 'Teknisi Kendaraan Berat', 'gaji' => 5500000],

                ['profesi' => 'Network Installer', 'gaji' => 7600000],
                ['profesi' => 'Satellite Technician', 'gaji' => 7800000],

                ['profesi' => 'Drafter Mesin', 'gaji' => 5500000],
                ['profesi' => 'Teknisi Perawatan Mesin Industri', 'gaji' => 5100000],

                ['profesi' => 'Manajer Fasilitas Gedung', 'gaji' => 9000000],
                ['profesi' => 'Supervisor Konstruksi Gedung', 'gaji' => 7600000],

                ['profesi' => 'Surveyor', 'gaji' => 7000000],
                ['profesi' => 'Teknisi Pemetaan', 'gaji' => 6500000],
            ],
            'Gojek' => [
                ['profesi' => 'Programmer', 'gaji' => 7500000],
                ['profesi' => 'Web Developer', 'gaji' => 8000000],
            ],
            'Tokopedia' => [
                ['profesi' => 'Web Developer', 'gaji' => 8500000],
                ['profesi' => 'Database Administrator', 'gaji' => 9000000],
            ],
            'Bukalapak' => [
                ['profesi' => 'System Analyst', 'gaji' => 8200000],
                ['profesi' => 'Programmer', 'gaji' => 7800000],
            ],
            'Traveloka' => [
                ['profesi' => 'Web Developer', 'gaji' => 8800000],
                ['profesi' => 'Cybersecurity Analyst', 'gaji' => 9500000],
            ],
            'Telkom Indonesia' => [
                ['profesi' => 'Network Engineer', 'gaji' => 8700000],
                ['profesi' => 'System Analyst', 'gaji' => 9000000],

                ['profesi' => 'Ahli Sistem Informasi Geografis', 'gaji' => 10000000],
                ['profesi' => 'Remote Sensing Analyst', 'gaji' => 9500000],
            ],
            'Indosat Ooredoo' => [
                ['profesi' => 'Network Engineer', 'gaji' => 8500000],
                ['profesi' => 'Cybersecurity Analyst', 'gaji' => 9300000],
            ],
            'XL Axiata' => [
                ['profesi' => 'Network Engineer', 'gaji' => 8300000],
                ['profesi' => 'Database Administrator', 'gaji' => 8800000],
            ],
            'Telkomsigma' => [
                ['profesi' => 'System Analyst', 'gaji' => 9200000],
                ['profesi' => 'Database Administrator', 'gaji' => 9400000],
            ],
            'Accenture' => [
                ['profesi' => 'Programmer', 'gaji' => 10000000],
                ['profesi' => 'System Analyst', 'gaji' => 11000000],
            ],
            'IBM Indonesia' => [
                ['profesi' => 'Cybersecurity Analyst', 'gaji' => 12000000],
                ['profesi' => 'Database Administrator', 'gaji' => 11500000],
            ],
            'Deloitte' => [
                ['profesi' => 'System Analyst', 'gaji' => 10000000],
                ['profesi' => 'Cybersecurity Analyst', 'gaji' => 11000000],
            ],
            'Bank Mandiri' => [
                ['profesi' => 'Database Administrator', 'gaji' => 9500000],
                ['profesi' => 'System Analyst', 'gaji' => 9700000],
            ],
            'Bank BCA' => [
                ['profesi' => 'Database Administrator', 'gaji' => 9800000],
                ['profesi' => 'Programmer', 'gaji' => 9000000],
            ],
            'Bank Negara Indonesia' => [
                ['profesi' => 'Cybersecurity Analyst', 'gaji' => 10500000],
                ['profesi' => 'System Analyst', 'gaji' => 9600000],
            ],
            'BSSN' => [
                ['profesi' => 'Cybersecurity Analyst', 'gaji' => 11500000],
                ['profesi' => 'Network Engineer', 'gaji' => 9500000],

                ['profesi' => 'Ahli Sistem Informasi Geografis', 'gaji' => 9500000],
                ['profesi' => 'Geomatik', 'gaji' => 8800000],
            ],
            'Vaksincom' => [
                ['profesi' => 'Cybersecurity Analyst', 'gaji' => 10000000],
                ['profesi' => 'Programmer', 'gaji' => 8700000],
            ],
            'Katalon' => [
                ['profesi' => 'Programmer', 'gaji' => 9500000],
                ['profesi' => 'System Analyst', 'gaji' => 9700000],
            ],
            'RCTI' => [
                ['profesi' => 'Broadcast Technician', 'gaji' => 6000000],
                ['profesi' => 'Teknisi Audio Visual', 'gaji' => 5800000],
            ],
            'Trans7' => [
                ['profesi' => 'Video Editor', 'gaji' => 6200000],
                ['profesi' => 'Sound Designer', 'gaji' => 6100000],
            ],
            'NET TV' => [
                ['profesi' => 'Motion Graphics Designer', 'gaji' => 7000000],
                ['profesi' => 'Video Motion Specialist', 'gaji' => 7200000],

                ['profesi' => 'Motion Designer', 'gaji' => 7500000],
                ['profesi' => 'Visual Storyteller', 'gaji' => 8000000],
            ],
            'MNC Animation' => [
                ['profesi' => 'Video Motion Specialist', 'gaji' => 7500000],
                ['profesi' => 'Motion Graphics Designer', 'gaji' => 7400000],

                ['profesi' => 'Animator', 'gaji' => 8500000],
                ['profesi' => 'Ilustrator', 'gaji' => 7000000],
            ],
            'Kompas TV' => [
                ['profesi' => 'Broadcast Technician', 'gaji' => 6100000],
                ['profesi' => 'Teknisi Audio Visual', 'gaji' => 5800000],

                ['profesi' => 'Visual Storyteller', 'gaji' => 7800000],
                ['profesi' => 'Desainer Grafis', 'gaji' => 7200000],
            ],
            'Metro TV' => [
                ['profesi' => 'Video Editor', 'gaji' => 6300000],
                ['profesi' => 'Sound Designer', 'gaji' => 6200000],
            ],
            'DreamWorks Animation' => [
                ['profesi' => 'Motion Graphics Designer', 'gaji' => 12000000],
                ['profesi' => 'Video Motion Specialist', 'gaji' => 13000000],

                ['profesi' => 'Animator', 'gaji' => 15000000],
                ['profesi' => 'Art Director', 'gaji' => 20000000],
            ],
            'Ogilvy Indonesia' => [
                ['profesi' => 'Motion Graphics Designer', 'gaji' => 9000000],
                ['profesi' => 'Video Editor', 'gaji' => 8500000],

                ['profesi' => 'Desainer Grafis', 'gaji' => 7000000],
                ['profesi' => 'Art Director', 'gaji' => 12000000],
            ],
            'YouTube Content Creators' => [
                ['profesi' => 'Video Editor', 'gaji' => 7000000],
                ['profesi' => 'Sound Designer', 'gaji' => 6800000],

                ['profesi' => 'Visual Storyteller', 'gaji' => 10000000],
                ['profesi' => 'Ilustrator', 'gaji' => 9000000],
            ],
            'VGI Global Media' => [
                ['profesi' => 'Motion Graphics Designer', 'gaji' => 8800000],
                ['profesi' => 'Teknisi Audio Visual', 'gaji' => 6200000],

                ['profesi' => 'Motion Designer', 'gaji' => 8000000],
                ['profesi' => 'Animator', 'gaji' => 8500000],
            ],
            'PT. Telekomunikasi Indonesia' => [
                ['profesi' => 'Teknisi Telekomunikasi', 'gaji' => 7500000],
                ['profesi' => 'Network Installer', 'gaji' => 7300000],
            ],
            'PT. FiberStar' => [
                ['profesi' => 'Teknisi Fiber Optik', 'gaji' => 7000000],
                ['profesi' => 'Network Installer', 'gaji' => 7200000],
            ],
            'Smartfren' => [
                ['profesi' => 'Operator BTS', 'gaji' => 7100000],
                ['profesi' => 'Teknisi Telekomunikasi', 'gaji' => 7300000],
            ],
            '3 (Tri) Indonesia' => [
                ['profesi' => 'Operator BTS', 'gaji' => 7000000],
                ['profesi' => 'Telecom Technician', 'gaji' => 7200000],
            ],
            'PT. LG Electronics Indonesia' => [
                ['profesi' => 'Teknisi Telekomunikasi', 'gaji' => 7800000],
                ['profesi' => 'Teknisi Fiber Optik', 'gaji' => 7400000],
            ],
            'PT. Samsung Electronics Indonesia' => [
                ['profesi' => 'Telecom Technician', 'gaji' => 8000000],
                ['profesi' => 'Teknisi Telekomunikasi', 'gaji' => 7700000],
            ],
            'PT. Total Bangun Persada' => [
                ['profesi' => 'Teknisi Telekomunikasi', 'gaji' => 7500000],
                ['profesi' => 'Network Installer', 'gaji' => 7400000],

                ['profesi' => 'Arsitek', 'gaji' => 7000000],
                ['profesi' => 'Project Architect', 'gaji' => 8500000],

                ['profesi' => 'Teknisi Instalasi Gedung', 'gaji' => 6200000],
                ['profesi' => 'Estimator Konstruksi', 'gaji' => 7100000],

                ['profesi' => 'Teknisi Pemetaan', 'gaji' => 6800000],
                ['profesi' => 'Geomatik', 'gaji' => 7000000],
            ],
            'PT. Ciputra Development' => [
                ['profesi' => 'Satellite Technician', 'gaji' => 7200000],
                ['profesi' => 'Teknisi Fiber Optik', 'gaji' => 7100000],

                ['profesi' => 'Desainer Interior', 'gaji' => 7500000],
                ['profesi' => 'Desainer Retail', 'gaji' => 6800000],

                ['profesi' => 'Manajer Fasilitas Gedung', 'gaji' => 8800000],
                ['profesi' => 'Teknisi Pemeliharaan Bangunan', 'gaji' => 5800000],

                ['profesi' => 'Surveyor', 'gaji' => 7200000],
                ['profesi' => 'Geomatik', 'gaji' => 7500000],
            ],
            'PT. Airmas Asri' => [
                ['profesi' => 'Telecom Technician', 'gaji' => 7300000],
                ['profesi' => 'Network Installer', 'gaji' => 7000000],

                ['profesi' => 'Arsitek', 'gaji' => 8000000],
                ['profesi' => 'Desainer Furniture', 'gaji' => 6800000],
            ],
            'PT. Lippo Karawaci' => [
                ['profesi' => '3D Visualizer', 'gaji' => 7200000],
                ['profesi' => 'Desainer Interior', 'gaji' => 7400000],
            ],
            'Informa' => [
                ['profesi' => 'Desainer Furniture', 'gaji' => 6500000],
            ],
            'IKEA Indonesia' => [
                ['profesi' => 'Desainer Interior', 'gaji' => 7000000],
                ['profesi' => 'Desainer Furniture', 'gaji' => 6700000],
            ],
            'PT. Pembangunan Perumahan' => [
                ['profesi' => 'Supervisor Konstruksi Gedung', 'gaji' => 7500000],
                ['profesi' => 'Estimator Konstruksi', 'gaji' => 7200000],

                ['profesi' => 'Surveyor', 'gaji' => 7500000],
                ['profesi' => 'Ahli Sistem Informasi Geografis', 'gaji' => 9000000],
            ],
            'PT. Garda Utama Indonesia' => [
                ['profesi' => 'Teknisi Pemeliharaan Bangunan', 'gaji' => 5600000],
                ['profesi' => 'Ahli Sanitasi Bangunan', 'gaji' => 6000000],
            ],
            'PT. Securindo Packatama Indonesia' => [
                ['profesi' => 'Manajer Fasilitas Gedung', 'gaji' => 8500000],
                ['profesi' => 'Teknisi Instalasi Gedung', 'gaji' => 6100000],
            ],
            'Leo Burnett' => [
                ['profesi' => 'Desainer Grafis', 'gaji' => 7500000],
                ['profesi' => 'Visual Storyteller', 'gaji' => 8500000],
            ],
            'Studio Ghibli' => [
                ['profesi' => 'Ilustrator', 'gaji' => 16000000],
                ['profesi' => 'Animator', 'gaji' => 18000000],
            ],
            'Electronic Arts' => [
                ['profesi' => 'Motion Designer', 'gaji' => 17000000],
                ['profesi' => 'Art Director', 'gaji' => 22000000],
            ],
            'PT. Urban+ Indonesia' => [
                ['profesi' => 'Cartographer', 'gaji' => 7000000],
                ['profesi' => 'Remote Sensing Analyst', 'gaji' => 7200000],
            ],
        ];
        $allProfesi = ProfesiKerja::pluck('id', 'nama_profesi_kerja')->toArray();
        foreach ($industriProfesiMap as $industriName => $profesiList) {
            $industri = Industri::where('nama_industri', $industriName)->first();
            if (!$industri) continue;

            $attachData = [];
            foreach ($profesiList as $data) {
                if (isset($allProfesi[$data['profesi']])) {
                    $attachData[$allProfesi[$data['profesi']]] = ['gaji' => $data['gaji']];
                }
            }

            if (!empty($attachData)) {
                $industri->profesiKerjas()->syncWithoutDetaching($attachData);
            }
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
            ],
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

        // Jurusan Kuliah
        $jurusanKuliahPerJurusan = [
            'TKR' => [
                ['nama_jurusan_kuliah' => 'Teknik Mesin Otomotif', 'deskripsi' => 'Fokus pada sistem mekanik kendaraan, perawatan, dan inovasi otomotif.', 'info_matkul' => 'Mekanika Otomotif, Termodinamika, Teknologi Kendaraan, Manufaktur Komponen Otomotif.', 'info_prospek' => 'Engineer otomotif, teknisi permesinan, perancang sistem kendaraan.', 'info_jurusan' => 'TKR',],
                ['nama_jurusan_kuliah' => 'Teknik Otomotif', 'deskripsi' => 'Mempelajari sistem kendaraan, diagnosis, dan teknologi otomotif modern.', 'info_matkul' => 'Sistem Bahan Bakar, Transmisi, Diagnostik Otomotif, Manajemen Bengkel.', 'info_prospek' => 'Mekanik kendaraan, teknisi otomotif, quality control kendaraan.', 'info_jurusan' => 'TKR',],
                ['nama_jurusan_kuliah' => 'Teknik Elektro Otomotif', 'deskripsi' => 'Mengkaji manajemen produksi dan efisiensi sistem manufaktur kendaraan.', 'info_matkul' => 'Manajemen Produksi, Ergonomi Industri, Supply Chain Otomotif, Analisis Proses.', 'info_prospek' => 'Planner produksi otomotif, analis sistem industri, manajer lini produksi.', 'info_jurusan' => 'TKR',],
            ],
            'SIJA' => [
                ['nama_jurusan_kuliah' => 'Teknik Informatika', 'deskripsi' => 'Mempelajari pemrograman, jaringan, dan rekayasa perangkat lunak.', 'info_matkul' => 'Algoritma, Basis Data, Struktur Data, Jaringan Komputer.', 'info_prospek' => 'Programmer, software engineer, web developer.', 'info_jurusan' => 'SIJA'],
                ['nama_jurusan_kuliah' => 'Sistem Informasi', 'deskripsi' => 'Menggabungkan teknologi dan bisnis untuk mengelola informasi.', 'info_matkul' => 'Analisis Sistem, Database, E-Business, Manajemen Proyek TI.', 'info_prospek' => 'System analyst, IT consultant, database administrator.', 'info_jurusan' => 'SIJA'],
                ['nama_jurusan_kuliah' => 'Teknologi Informasi', 'deskripsi' => 'Fokus pada penerapan teknologi di berbagai sektor industri.', 'info_matkul' => 'Cloud Computing, IoT, Keamanan Jaringan, Pemrograman Web.', 'info_prospek' => 'Network engineer, IT support, cybersecurity specialist.', 'info_jurusan' => 'SIJA'],
            ],
            'TAV' => [
                ['nama_jurusan_kuliah' => 'Teknik Audio Video', 'deskripsi' => 'Mengembangkan sistem siaran dan produksi multimedia.', 'info_matkul' => 'Audio System, Video Editing, Elektronika Dasar, Sistem Transmisi.', 'info_prospek' => 'Teknisi broadcasting, editor video, teknisi studio.', 'info_jurusan' => 'TAV'],
                ['nama_jurusan_kuliah' => 'Film dan Televisi', 'deskripsi' => 'Mempelajari produksi film, penyutradaraan, dan editing.', 'info_matkul' => 'Sinematografi, Penyutradaraan, Produksi Film, Editing.', 'info_prospek' => 'Sutradara, editor, produser media visual.', 'info_jurusan' => 'TAV'],
                ['nama_jurusan_kuliah' => 'Seni Media Rekam', 'deskripsi' => 'Belajar produksi audio, foto, dan video profesional.', 'info_matkul' => 'Fotografi, Audio Produksi, Videografi, Editing Multimedia.', 'info_prospek' => 'Fotografer, editor audio visual, content creator.', 'info_jurusan' => 'TAV'],
            ],
            'TITL' => [
                ['nama_jurusan_kuliah' => 'Teknik Elektro', 'deskripsi' => 'Fokus pada sistem kelistrikan dan kontrol otomatis.', 'info_matkul' => 'Rangkaian Listrik, Elektronika Daya, Sistem Tenaga, PLC.', 'info_prospek' => 'Teknisi listrik, kontrol sistem, perancang instalasi tenaga.', 'info_jurusan' => 'TITL'],
                ['nama_jurusan_kuliah' => 'Teknik Telekomunikasi', 'deskripsi' => 'Mempelajari sistem komunikasi modern dan transmisi data.', 'info_matkul' => 'Sinyal dan Sistem, Komunikasi Data, Fiber Optik.', 'info_prospek' => 'Network engineer, teknisi komunikasi, maintenance fiber.', 'info_jurusan' => 'TITL'],
                ['nama_jurusan_kuliah' => 'Teknik Komputer', 'deskripsi' => 'Gabungan antara ilmu komputer dan elektronika.', 'info_matkul' => 'Embedded System, Mikrokontroler, Pemrograman Sistem.', 'info_prospek' => 'IoT developer, embedded engineer, teknisi hardware.', 'info_jurusan' => 'TITL'],
            ],
            'DKV' => [
                ['nama_jurusan_kuliah' => 'Desain Komunikasi Visual', 'deskripsi' => 'Fokus pada komunikasi ide melalui media visual.', 'info_matkul' => 'Tipografi, Fotografi, Desain Grafis, Branding.', 'info_prospek' => 'Desainer grafis, ilustrator, creative director.', 'info_jurusan' => 'DKV'],
                ['nama_jurusan_kuliah' => 'Animasi', 'deskripsi' => 'Mempelajari pembuatan animasi 2D/3D profesional.', 'info_matkul' => 'Storyboarding, Modeling, Rigging, Visual Effect.', 'info_prospek' => 'Animator, motion designer, 3D artist.', 'info_jurusan' => 'DKV'],
                ['nama_jurusan_kuliah' => 'Desain Produk', 'deskripsi' => 'Mendesain produk fisik fungsional dan estetis.', 'info_matkul' => 'Desain Industri, CAD, Ergonomi, Inovasi Produk.', 'info_prospek' => 'Desainer produk, konsultan desain, R&D engineer.', 'info_jurusan' => 'DKV'],
            ],
            'DPIB' => [
                ['nama_jurusan_kuliah' => 'Arsitektur', 'deskripsi' => 'Fokus pada desain dan konstruksi bangunan hunian dan publik.', 'info_matkul' => 'Desain Arsitektur, Autocad, Struktur Bangunan, Estetika Desain.', 'info_prospek' => 'Arsitek, drafter, konsultan desain arsitektur.', 'info_jurusan' => 'DPIB'],
                ['nama_jurusan_kuliah' => 'Desain Interior', 'deskripsi' => 'Mempelajari tata ruang dan estetika interior bangunan modern.', 'info_matkul' => 'Estetika Ruang, Material Interior, Pencahayaan, Tata Ruang.', 'info_prospek' => 'Desainer interior, kontraktor desain, visualisasi ruang.', 'info_jurusan' => 'DPIB'],
                ['nama_jurusan_kuliah' => 'Teknologi Rekayasa Konstruksi', 'deskripsi' => 'Menitikberatkan pada perancangan dan pembangunan struktur sipil.', 'info_matkul' => 'Mekanika Tanah, Struktur Beton, Hidrolika, Gambar Konstruksi.', 'info_prospek' => 'Insinyur sipil, pengawas proyek, konsultan konstruksi.', 'info_jurusan' => 'DPIB'],
            ],
            'KGSP' => [
                ['nama_jurusan_kuliah' => 'Manajemen Konstruksi', 'deskripsi' => 'Fokus pada perencanaan, pengawasan, dan evaluasi proyek konstruksi.', 'info_matkul' => 'Estimasi Biaya, Scheduling, Manajemen Proyek, Analisis Risiko.', 'info_prospek' => 'Project manager, estimator, pengawas lapangan.', 'info_jurusan' => 'KGSP'],
                ['nama_jurusan_kuliah' => 'Teknik Bangunan Gedung', 'deskripsi' => 'Mempelajari metode pembangunan, utilitas, dan perawatan gedung.', 'info_matkul' => 'Struktur Gedung, Utilitas Bangunan, Gambar Teknik, Keselamatan Kerja.', 'info_prospek' => 'Teknisi bangunan, drafter, pengawas proyek konstruksi.', 'info_jurusan' => 'KGSP'],
                ['nama_jurusan_kuliah' => 'Teknik Sipil', 'deskripsi' => 'Menitikberatkan pada perancangan jalan, jembatan, dan drainase.', 'info_matkul' => 'Struktur Baja, Geoteknik, Drainase, Beton Bertulang.', 'info_prospek' => 'Insinyur sipil, kontraktor jalan, konsultan infrastruktur.', 'info_jurusan' => 'KGSP'],
            ],
            'TP' => [
                ['nama_jurusan_kuliah' => 'Teknik Mesin Manufaktur', 'deskripsi' => 'Menitikberatkan pada desain dan perawatan sistem manufaktur mekanik.', 'info_matkul' => 'Thermodinamika, Mekanika Fluida, Material Teknik, Proses Produksi.', 'info_prospek' => 'Desainer mesin, teknisi pabrik, engineer manufaktur.', 'info_jurusan' => 'TP'],
                ['nama_jurusan_kuliah' => 'Teknik Industri', 'deskripsi' => 'Fokus pada optimasi proses produksi dan efisiensi sistem kerja.', 'info_matkul' => 'Optimasi Produksi, Logistik Industri, Supply Chain Management.', 'info_prospek' => 'Analis proses industri, supervisor manufaktur, manajer produksi.', 'info_jurusan' => 'TP'],
                ['nama_jurusan_kuliah' => 'Teknik Manufaktur', 'deskripsi' => 'Mempelajari teknologi permesinan presisi dan pengendalian kualitas.', 'info_matkul' => 'CNC, CAD/CAM, Pengukuran Presisi, Kontrol Kualitas Produk.', 'info_prospek' => 'Operator CNC, quality control, perancang alat presisi.', 'info_jurusan' => 'TP'],
            ],
            'GEO' => [
                ['nama_jurusan_kuliah' => 'Teknik Geodesi', 'deskripsi' => 'Pemodelan permukaan bumi dan pemetaan digital.', 'info_matkul' => 'Surveying, Geodesi Satelit, GIS, Fotogrametri.', 'info_prospek' => 'Surveyor, GIS specialist, konsultan pemetaan.', 'info_jurusan' => 'GEO'],
                ['nama_jurusan_kuliah' => 'Geografi', 'deskripsi' => 'Analisis fenomena ruang dan lingkungan.', 'info_matkul' => 'Geografi Fisik, Kartografi, Penginderaan Jauh.', 'info_prospek' => 'Analis wilayah, pengembang tata ruang, peneliti geospasial.', 'info_jurusan' => 'GEO'],
                ['nama_jurusan_kuliah' => 'Teknologi Survei dan Pemetaan', 'deskripsi' => 'Teknik pemetaan dan sistem geospasial modern.', 'info_matkul' => 'Topografi, GIS, Remote Sensing, Pemetaan Digital.', 'info_prospek' => 'Surveyor pemetaan, GIS engineer, analis geospasial.', 'info_jurusan' => 'GEO'],
            ],
        ];
        foreach ($jurusanKuliahPerJurusan as $jurusanName => $jurusanKuliahs) {
            foreach ($jurusanKuliahs as $jurusanKuliah) {
                JurusanKuliah::create($jurusanKuliah);
            }
        }

        // Kampus
        $kampusList = [
            ['nama_kampus' => 'Universitas Gadjah Mada', 'website' => 'https://www.ugm.ac.id', 'alamat' => 'Yogyakarta'],
            ['nama_kampus' => 'Institut Teknologi Sepuluh Nopember', 'website' => 'https://www.its.ac.id', 'alamat' => 'Surabaya, Jawa Timur'],
            ['nama_kampus' => 'Universitas Indonesia', 'website' => 'https://www.ui.ac.id', 'alamat' => 'Depok, Jawa Barat'],
            ['nama_kampus' => 'Universitas Brawijaya', 'website' => 'https://www.ub.ac.id', 'alamat' => 'Malang, Jawa Timur'],
            ['nama_kampus' => 'Telkom University', 'website' => 'https://telkomuniversity.ac.id', 'alamat' => 'Bandung, Jawa Barat'],
            ['nama_kampus' => 'Universitas Negeri Yogyakarta', 'website' => 'https://www.uny.ac.id', 'alamat' => 'Yogyakarta'],
            ['nama_kampus' => 'Politeknik Negeri Bandung', 'website' => 'https://www.polban.ac.id', 'alamat' => 'Bandung, Jawa Barat'],
            ['nama_kampus' => 'Universitas Diponegoro', 'website' => 'https://www.undip.ac.id', 'alamat' => 'Semarang, Jawa Tengah'],
            ['nama_kampus' => 'Institut Seni Indonesia Yogyakarta', 'website' => 'https://www.isi.ac.id', 'alamat' => 'Yogyakarta'],
            ['nama_kampus' => 'Universitas Atma Jaya Yogyakarta', 'website' => 'https://www.uajy.ac.id', 'alamat' => 'Yogyakarta'],
            ['nama_kampus' => 'Universitas Muhammadiyah Yogyakarta', 'website' => 'https://www.umy.ac.id', 'alamat' => 'Yogyakarta'],
            ['nama_kampus' => 'Universitas Kristen Petra', 'website' => 'https://www.petra.ac.id', 'alamat' => 'Surabaya, Jawa Timur'],
            ['nama_kampus' => 'Politeknik Negeri Semarang', 'website' => 'https://www.polines.ac.id', 'alamat' => 'Semarang, Jawa Tengah'],
            ['nama_kampus' => 'Universitas Negeri Malang', 'website' => 'https://www.um.ac.id', 'alamat' => 'Malang, Jawa Timur'],
            ['nama_kampus' => 'Institut Teknologi Nasional Malang', 'website' => 'https://www.itn.ac.id', 'alamat' => 'Malang, Jawa Timur'],
            ['nama_kampus' => 'Universitas Negeri Jakarta', 'website' => 'https://www.unj.ac.id', 'alamat' => 'Jakarta Timur, DKI Jakarta'],
            ['nama_kampus' => 'Politeknik Negeri Jakarta', 'website' => 'https://www.pnj.ac.id', 'alamat' => 'Jakarta, DKI Jakarta'],
        ];
        foreach ($kampusList as $kampus) {
            Kampus::create($kampus);
        }

        // Kampus Jurusan Map
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

        // Hobi - Jurusan Map
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
