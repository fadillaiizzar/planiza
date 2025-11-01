<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            KelasJurusanRencanaSeeder::class,
            UserSeeder::class,
            ProfesiKerjaSeeder::class,
            IndustriSeeder::class,
            IndustriProfesiSeeder::class,
            KategoriMinatSeeder::class,
            ProfesiKategoriSeeder::class,
            MateriSeeder::class,
            TesSeeder::class,
            JurusanKuliahSeeder::class,
            KampusSeeder::class,
            KampusJurusanSeeder::class,
            HobiSeeder::class,
            HobiJurusanSeeder::class,
            KategoriSdgsSeeder::class,
        ]);
    }
}
