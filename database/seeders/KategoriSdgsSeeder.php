<?php

namespace Database\Seeders;

use App\Models\KategoriSdgs;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriSdgsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoriSdgsList = [
            ['nomor_kategori' => 1, 'nama_kategori' => 'Tanpa Kemiskinan', 'deskripsi' => 'Memastikan semua orang punya cukup uang dan kebutuhan dasar untuk hidup layak'],
            ['nomor_kategori' => 2, 'nama_kategori' => 'Tanpa Kelaparan', 'deskripsi' => 'Memastikan semua orang mendapat makanan bergizi agar sehat dan kuat'],
            ['nomor_kategori' => 3, 'nama_kategori' => 'Kesehatan dan Kesejahteraan', 'deskripsi' => 'Memberikan akses layanan kesehatan untuk hidup sehat dan sejahtera'],
            ['nomor_kategori' => 4, 'nama_kategori' => 'Pendidikan Berkualitas', 'deskripsi' => 'Memberikan pendidikan yang baik dan merata untuk semua orang'],
            ['nomor_kategori' => 5, 'nama_kategori' => 'Kesetaraan Gender', 'deskripsi' => 'Memberikan hak dan kesempatan yang sama bagi laki-laki dan perempuan'],
            ['nomor_kategori' => 6, 'nama_kategori' => 'Air Bersih dan Sanitasi', 'deskripsi' => 'Memberikan air bersih dan fasilitas sanitasi untuk hidup sehat'],
            ['nomor_kategori' => 7, 'nama_kategori' => 'Energi Bersih dan Terjangkau', 'deskripsi' => 'Memberikan energi yang aman, bersih, dan terjangkau bagi semua'],
            ['nomor_kategori' => 8, 'nama_kategori' => 'Pekerjaan Layak dan Pertumbuhan Ekonomi', 'deskripsi' => 'Menciptakan pekerjaan yang adil dan mendukung pertumbuhan ekonomi'],
            ['nomor_kategori' => 9, 'nama_kategori' => 'Industri, Inovasi, dan Infrastruktur', 'deskripsi' => 'Membangun infrastruktur dan mendorong inovasi untuk kemajuan'],
            ['nomor_kategori' => 10, 'nama_kategori' => 'Pengurangan Kesenjangan', 'deskripsi' => 'Mengurangi kesenjangan sosial, ekonomi, dan kesempatan antar orang'],
            ['nomor_kategori' => 11, 'nama_kategori' => 'Kota dan Komunitas yang Berkelanjutan', 'deskripsi' => 'Menciptakan kota yang aman, nyaman, dan ramah lingkungan'],
            ['nomor_kategori' => 12, 'nama_kategori' => 'Konsumsi dan Produksi yang Bertanggung Jawab', 'deskripsi' => 'Menggunakan sumber daya dengan bijak dan mengurangi limbah'],
            ['nomor_kategori' => 13, 'nama_kategori' => 'Penanganan Perubahan Iklim', 'deskripsi' => 'Mengurangi dampak perubahan iklim dan menjaga lingkungan'],
            ['nomor_kategori' => 14, 'nama_kategori' => 'Kehidupan di Bawah Air', 'deskripsi' => 'Melindungi laut dan ekosistemnya agar tetap sehat'],
            ['nomor_kategori' => 15, 'nama_kategori' => 'Kehidupan di Darat', 'deskripsi' => 'Melindungi hutan, tanah, dan makhluk hidup di darat'],
            ['nomor_kategori' => 16, 'nama_kategori' => 'Perdamaian, Keadilan, dan Kelembagaan yang Kuat', 'deskripsi' => 'Membangun masyarakat yang damai, adil, dan tertib'],
            ['nomor_kategori' => 17, 'nama_kategori' => 'Kemitraan untuk Mencapai Tujuan', 'deskripsi' => 'Mendorong kerja sama semua pihak untuk mencapai tujuan pembangunan'],
        ];
        foreach ($kategoriSdgsList as $kategori) {
            KategoriSdgs::create($kategori);
        }
    }
}
