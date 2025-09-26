<?php

namespace Database\Seeders;

use App\Models\Industri;
use App\Models\Role;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Rencana;
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
                ['nama_profesi_kerja' => 'Montir Truk dan Bus', 'gaji' => 3700000, 'deskripsi' => 'Perbaikan kendaraan besar', 'info_skill' => 'Sistem Suspensi Berat', 'info_jurusan' => 'TKR'],
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
                ['nama_profesi_kerja' => 'Animator', 'gaji' => 4500000, 'deskripsi' => 'Membuat animasi digital', 'info_skill' => '3D Modeling', 'info_jurusan' => 'TAV'],
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
                ['nama_profesi_kerja' => 'Teknisi Pendingin', 'gaji' => 3800000, 'deskripsi' => 'Perbaikan AC dan kulkas', 'info_skill' => 'Diagnosa AC', 'info_jurusan' => 'TP'],
                ['nama_profesi_kerja' => 'Teknisi Refrigerasi', 'gaji' => 4000000, 'deskripsi' => 'Merawat sistem pendingin industri', 'info_skill' => 'Sistem Refrigerasi Industri', 'info_jurusan' => 'TP'],
                ['nama_profesi_kerja' => 'Instalasi HVAC', 'gaji' => 4200000, 'deskripsi' => 'Pemasangan sistem HVAC', 'info_skill' => 'Pemasangan HVAC', 'info_jurusan' => 'TP'],
                ['nama_profesi_kerja' => 'Maintenance AC Gedung', 'gaji' => 3900000, 'deskripsi' => 'Perawatan sistem AC gedung', 'info_skill' => 'AC Central', 'info_jurusan' => 'TP'],
                ['nama_profesi_kerja' => 'Teknisi Kulkas Industri', 'gaji' => 4100000, 'deskripsi' => 'Perawatan kulkas industri dan cold storage', 'info_skill' => 'Cold Storage System', 'info_jurusan' => 'TP'],
                ['nama_profesi_kerja' => 'Teknisi Ventilasi', 'gaji' => 4000000, 'deskripsi' => 'Pemasangan dan perawatan ventilasi', 'info_skill' => 'Ducting System', 'info_jurusan' => 'TP'],
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
                ['nama_profesi_kerja' => 'Pengelola Gedung', 'gaji' => 3500000, 'deskripsi' => 'Manajemen gedung dan fasilitas', 'info_skill' => 'Facility Management', 'info_jurusan' => 'KGSP'],
                ['nama_profesi_kerja' => 'Satpam', 'gaji' => 3200000, 'deskripsi' => 'Keamanan dan pengawasan', 'info_skill' => 'Patroli Keamanan', 'info_jurusan' => 'KGSP'],
                ['nama_profesi_kerja' => 'Teknisi Bangunan', 'gaji' => 3600000, 'deskripsi' => 'Perawatan gedung dan fasilitas', 'info_skill' => 'Maintenance Bangunan', 'info_jurusan' => 'KGSP'],
                ['nama_profesi_kerja' => 'Cleaning Service Manager', 'gaji' => 3300000, 'deskripsi' => 'Mengatur kebersihan gedung', 'info_skill' => 'Manajemen Cleaning', 'info_jurusan' => 'KGSP'],
                ['nama_profesi_kerja' => 'Teknisi Listrik Gedung', 'gaji' => 3700000, 'deskripsi' => 'Perawatan instalasi listrik gedung', 'info_skill' => 'Electrical Wiring', 'info_jurusan' => 'KGSP'],
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
    }
}
