<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin Utama',
            'email' => 'admin@eluna.com',
            'password' => Hash::make('admin123'), // ganti sesuai kebutuhan
            'role' => 'admin',
            'jabatan' => 'ADMIN GUDANG',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
