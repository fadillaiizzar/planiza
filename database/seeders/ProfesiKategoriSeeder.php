<?php

namespace Database\Seeders;

use App\Models\ProfesiKerja;
use App\Models\KategoriMinat;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProfesiKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}
