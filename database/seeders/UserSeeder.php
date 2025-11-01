<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Rencana;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $administratorRole = Role::where('nama_role', 'Administrator')->first();
        $adminRole = Role::where('nama_role', 'Admin')->first();
        $siswaRole = Role::where('nama_role', 'Siswa')->first();

        // Admin & Administrator
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

        // Siswa
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
    }
}
