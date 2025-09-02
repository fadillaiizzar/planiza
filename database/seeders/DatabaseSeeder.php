<?php

namespace Database\Seeders;

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
                ['nama_profesi_kerja' => 'Teknisi Otomotif', 'gaji' => 3500000, 'deskripsi' => 'Mekanik dan perbaikan kendaraan', 'info_skill' => 'Mekanik, Elektronik', 'info_jurusan' => 'TKR'],
                ['nama_profesi_kerja' => 'Operator Mesin Industri', 'gaji' => 3300000, 'deskripsi' => 'Mengoperasikan mesin produksi', 'info_skill' => 'Teknik Mesin', 'info_jurusan' => 'TKR'],
                ['nama_profesi_kerja' => 'Teknisi Listrik Otomotif', 'gaji' => 3600000, 'deskripsi' => 'Perawatan sistem listrik kendaraan', 'info_skill' => 'Listrik, Elektronika', 'info_jurusan' => 'TKR'],
            ],
            'SIJA' => [
                ['nama_profesi_kerja' => 'Programmer', 'gaji' => 5000000, 'deskripsi' => 'Pengembang perangkat lunak', 'info_skill' => 'Coding, Analisis', 'info_jurusan' => 'SIJA'],
                ['nama_profesi_kerja' => 'Web Developer', 'gaji' => 4500000, 'deskripsi' => 'Membangun aplikasi web', 'info_skill' => 'HTML, CSS, JS', 'info_jurusan' => 'SIJA'],
                ['nama_profesi_kerja' => 'Network Engineer', 'gaji' => 4800000, 'deskripsi' => 'Mengelola jaringan komputer', 'info_skill' => 'Networking, Server', 'info_jurusan' => 'SIJA'],
            ],
            'TAV' => [
                ['nama_profesi_kerja' => 'Teknisi Audio Visual', 'gaji' => 4000000, 'deskripsi' => 'Perawatan alat audio-visual', 'info_skill' => 'Elektronik, Editing', 'info_jurusan' => 'TAV'],
                ['nama_profesi_kerja' => 'Video Editor', 'gaji' => 4200000, 'deskripsi' => 'Mengedit video dan animasi', 'info_skill' => 'Premiere, After Effects', 'info_jurusan' => 'TAV'],
                ['nama_profesi_kerja' => 'Animator', 'gaji' => 4500000, 'deskripsi' => 'Membuat animasi digital', 'info_skill' => '2D/3D Animation', 'info_jurusan' => 'TAV'],
            ],
            'TITL' => [
                ['nama_profesi_kerja' => 'Teknisi Telekomunikasi', 'gaji' => 4200000, 'deskripsi' => 'Instalasi jaringan komunikasi', 'info_skill' => 'Jaringan, Elektronik', 'info_jurusan' => 'TITL'],
                ['nama_profesi_kerja' => 'Teknisi Fiber Optik', 'gaji' => 4400000, 'deskripsi' => 'Perawatan kabel dan jaringan fiber', 'info_skill' => 'Jaringan, Mekanik', 'info_jurusan' => 'TITL'],
                ['nama_profesi_kerja' => 'Operator BTS', 'gaji' => 4300000, 'deskripsi' => 'Mengelola tower dan komunikasi', 'info_skill' => 'Elektronik, Monitoring', 'info_jurusan' => 'TITL'],
            ],
            'TP' => [
                ['nama_profesi_kerja' => 'Teknisi Pendingin', 'gaji' => 3800000, 'deskripsi' => 'Perbaikan AC dan kulkas', 'info_skill' => 'Mekanik, Elektronik', 'info_jurusan' => 'TP'],
                ['nama_profesi_kerja' => 'Teknisi Refrigerasi', 'gaji' => 4000000, 'deskripsi' => 'Merawat sistem pendingin industri', 'info_skill' => 'Mekanik, Listrik', 'info_jurusan' => 'TP'],
                ['nama_profesi_kerja' => 'Instalasi HVAC', 'gaji' => 4200000, 'deskripsi' => 'Pemasangan sistem HVAC', 'info_skill' => 'Teknik Pendingin', 'info_jurusan' => 'TP'],
            ],
            'DPIB' => [
                ['nama_profesi_kerja' => 'Desainer Interior', 'gaji' => 4500000, 'deskripsi' => 'Perancang interior', 'info_skill' => 'Desain, Kreatif', 'info_jurusan' => 'DPIB'],
                ['nama_profesi_kerja' => 'Arsitek', 'gaji' => 5000000, 'deskripsi' => 'Perancangan bangunan', 'info_skill' => 'AutoCAD, Kreatif', 'info_jurusan' => 'DPIB'],
                ['nama_profesi_kerja' => 'Desainer Furniture', 'gaji' => 4300000, 'deskripsi' => 'Mendesain dan membuat furniture', 'info_skill' => 'Kreatif, Mekanik', 'info_jurusan' => 'DPIB'],
            ],
            'KGSP' => [
                ['nama_profesi_kerja' => 'Pengelola Gedung', 'gaji' => 3500000, 'deskripsi' => 'Manajemen gedung dan fasilitas', 'info_skill' => 'Organisasi, Administrasi', 'info_jurusan' => 'KGSP'],
                ['nama_profesi_kerja' => 'Satpam', 'gaji' => 3200000, 'deskripsi' => 'Keamanan dan pengawasan', 'info_skill' => 'Keamanan, Disiplin', 'info_jurusan' => 'KGSP'],
                ['nama_profesi_kerja' => 'Teknisi Bangunan', 'gaji' => 3600000, 'deskripsi' => 'Perawatan gedung dan fasilitas', 'info_skill' => 'Mekanik, Elektrik', 'info_jurusan' => 'KGSP'],
            ],
            'DKV' => [
                ['nama_profesi_kerja' => 'Desainer Grafis', 'gaji' => 4000000, 'deskripsi' => 'Membuat desain visual', 'info_skill' => 'Kreatif, Software Desain', 'info_jurusan' => 'DKV'],
                ['nama_profesi_kerja' => 'Ilustrator', 'gaji' => 4200000, 'deskripsi' => 'Membuat ilustrasi digital', 'info_skill' => 'Digital Art, Kreatif', 'info_jurusan' => 'DKV'],
                ['nama_profesi_kerja' => 'Animator', 'gaji' => 4500000, 'deskripsi' => 'Membuat animasi kreatif', 'info_skill' => '2D/3D Animation', 'info_jurusan' => 'DKV'],
            ],
            'GEO' => [
                ['nama_profesi_kerja' => 'Surveyor', 'gaji' => 3800000, 'deskripsi' => 'Pengukuran tanah dan pemetaan', 'info_skill' => 'Matematika, GPS', 'info_jurusan' => 'GEO'],
                ['nama_profesi_kerja' => 'Geomatik', 'gaji' => 4000000, 'deskripsi' => 'Pengolahan data geospasial', 'info_skill' => 'GIS, Mapping', 'info_jurusan' => 'GEO'],
                ['nama_profesi_kerja' => 'Teknisi Pemetaan', 'gaji' => 3900000, 'deskripsi' => 'Membuat peta dan survei lapangan', 'info_skill' => 'GPS, Survey', 'info_jurusan' => 'GEO'],
            ],
        ];
        foreach ($profesiPerJurusan as $jurusanName => $profesis) {
            foreach ($profesis as $profesi) {
                ProfesiKerja::create($profesi);
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
    }
}
