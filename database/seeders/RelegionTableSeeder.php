<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RelegionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $religions = [
            ['agama' => 'Islam', 'created_at' => now(), 'updated_at' => now()],
            ['agama' => 'Kristen (Protestan)', 'created_at' => now(), 'updated_at' => now()],
            ['agama' => 'Katolik', 'created_at' => now(), 'updated_at' => now()],
            ['agama' => 'Hindu', 'created_at' => now(), 'updated_at' => now()],
            ['agama' => 'Buddha', 'created_at' => now(), 'updated_at' => now()],
            ['agama' => 'Konghucu', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('religions')->insert($religions);
    }
}
