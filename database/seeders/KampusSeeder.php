<?php

namespace Database\Seeders;

use App\Models\Kampus;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KampusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}
