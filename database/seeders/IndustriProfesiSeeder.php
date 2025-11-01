<?php

namespace Database\Seeders;

use App\Models\Industri;
use App\Models\ProfesiKerja;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IndustriProfesiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}
