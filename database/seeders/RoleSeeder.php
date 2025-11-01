<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['nama_role' => 'Administrator'],
            ['nama_role' => 'Admin'],
            ['nama_role' => 'Siswa'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
