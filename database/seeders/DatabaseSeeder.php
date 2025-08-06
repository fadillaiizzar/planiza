<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Rencana;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Role::insert([
            ['nama_role' => 'Admin'],
            ['nama_role' => 'Siswa'],
        ]);

        User::create([
            'name' => 'Admin Utama',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role_id' => Role::where('nama_role', 'Admin')->first()->id,
        ]);

        Kelas::insert([
            ['nama_kelas' => 'X'],
            ['nama_kelas' => 'XI'],
            ['nama_kelas' => 'XII'],
            ['nama_kelas' => 'XIII'],
        ]);

        Jurusan::insert([
            ['nama_jurusan' => 'SIJA'],
            ['nama_jurusan' => 'TAV'],
            ['nama_jurusan' => 'TKR'],
            ['nama_jurusan' => 'TP'],
            ['nama_jurusan' => 'DPIB'],
        ]);

        Rencana::insert([
            ['nama_rencana' => 'Kerja'],
            ['nama_rencana' => 'Kuliah'],
        ]);
    }
}
