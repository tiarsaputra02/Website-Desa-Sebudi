<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MaritalStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $marital_statuses = [
            ['status_pernikahan' => 'Belum Kawin', 'created_at' => now(), 'updated_at' => now()],
            ['status_pernikahan' => 'Kawin', 'created_at' => now(), 'updated_at' => now()],
            ['status_pernikahan' => 'Cerai Hidup', 'created_at' => now(), 'updated_at' => now()],
            ['status_pernikahan' => 'Cerai Mati', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('marital_statuses')->insert($marital_statuses);
    }
}
