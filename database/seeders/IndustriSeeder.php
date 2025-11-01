<?php

namespace Database\Seeders;

use App\Models\Industri;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IndustriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}
