<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Materi;
use App\Models\Jurusan;
use App\Models\Rencana;
use App\Models\TopikMateri;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MateriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}
