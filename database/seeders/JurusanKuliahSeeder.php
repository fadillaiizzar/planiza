<?php

namespace Database\Seeders;

use App\Models\JurusanKuliah;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JurusanKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}
