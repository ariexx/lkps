<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create(['username' => 'superadmin', 'password' => bcrypt('superadmin'), 'name' => 'Super Admin', 'role' => 'superadmin']);
        User::factory()->create(['username' => 'admin_prodi', 'password' => bcrypt('admin_prodi'), 'name' => 'Admin Prodi', 'role' => 'admin_prodi']);
        User::factory()->create(['username' => 'dosen', 'password' => bcrypt('dosen'), 'name' => 'Dosen', 'role' => 'dosen']);
        User::factory()->create(['username' => 'prodi', 'password' => bcrypt('prodi'), 'name' => 'Prodi', 'role' => 'prodi']);
    }
}
