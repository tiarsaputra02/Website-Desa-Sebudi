<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VillageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $villages = [
            ['nama_wilayah' => 'Banjar Dinas Sorga', 'created_at' => now(), 'updated_at' => now()],
            ['nama_wilayah' => 'Banjar Dinas Sebudi', 'created_at' => now(), 'updated_at' => now()],
            ['nama_wilayah' => 'Banjar Dinas Badeg Dukuh', 'created_at' => now(), 'updated_at' => now()],
            ['nama_wilayah' => 'Banjar Dinas Badeg Tengah', 'created_at' => now(), 'updated_at' => now()],
            ['nama_wilayah' => 'Banjar Dinas Badeg Kelodan', 'created_at' => now(), 'updated_at' => now()],
            ['nama_wilayah' => 'Banjar Dinas Ancut ', 'created_at' => now(), 'updated_at' => now()],
            ['nama_wilayah' => 'Banjar Dinas Yeha ', 'created_at' => now(), 'updated_at' => now()],
            ['nama_wilayah' => 'Banjar Dinas Pura ', 'created_at' => now(), 'updated_at' => now()],
            ['nama_wilayah' => 'Banjar Dinas Lebih ', 'created_at' => now(), 'updated_at' => now()],
            ['nama_wilayah' => 'Banjar Dinas Telung Buana ', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('villages')->insert($villages);
    }
}
