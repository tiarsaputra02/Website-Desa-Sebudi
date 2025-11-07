<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['title' => 'Admin Utama', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Admin Desa', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Admin Banjar Sorga', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Admin Banjar Sebudi', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Admin Banjar Badeg Dukuh', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Admin Banjar Badeg Tengah', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Admin Banjar Badeg Kelodan', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Admin Banjar Ancut', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Admin Banjar Yeha', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Admin Banjar Pura', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Admin Banjar Lebih', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Admin Banjar Telung Buana', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('roles')->insert($roles);
    }
}
