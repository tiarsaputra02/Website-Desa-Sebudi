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
            ['nama_wilayah' => 'Banjar Dinas Sorga','desa' => 'Sebudi','kecamatan' => 'Selat','kabupaten'=> 'Karangasem', 'created_at' => now(), 'updated_at' => now()],
            ['nama_wilayah' => 'Banjar Dinas Sebudi','desa' => 'Sebudi','kecamatan' => 'Selat','kabupaten'=> 'Karangasem', 'created_at' => now(), 'updated_at' => now()],
            ['nama_wilayah' => 'Banjar Dinas Badeg Dukuh','desa' => 'Sebudi','kecamatan' => 'Selat','kabupaten'=> 'Karangasem', 'created_at' => now(), 'updated_at' => now()],
            ['nama_wilayah' => 'Banjar Dinas Badeg Tengah','desa' => 'Sebudi','kecamatan' => 'Selat','kabupaten'=> 'Karangasem', 'created_at' => now(), 'updated_at' => now()],
            ['nama_wilayah' => 'Banjar Dinas Badeg Kelodan','desa' => 'Sebudi','kecamatan' => 'Selat','kabupaten'=> 'Karangasem', 'created_at' => now(), 'updated_at' => now()],
            ['nama_wilayah' => 'Banjar Dinas Ancut ','desa' => 'Sebudi','kecamatan' => 'Selat','kabupaten'=> 'Karangasem', 'created_at' => now(), 'updated_at' => now()],
            ['nama_wilayah' => 'Banjar Dinas Yeha ','desa' => 'Sebudi','kecamatan' => 'Selat','kabupaten'=> 'Karangasem', 'created_at' => now(), 'updated_at' => now()],
            ['nama_wilayah' => 'Banjar Dinas Pura ','desa' => 'Sebudi','kecamatan' => 'Selat','kabupaten'=> 'Karangasem', 'created_at' => now(), 'updated_at' => now()],
            ['nama_wilayah' => 'Banjar Dinas Lebih ','desa' => 'Sebudi','kecamatan' => 'Selat','kabupaten'=> 'Karangasem', 'created_at' => now(), 'updated_at' => now()],
            ['nama_wilayah' => 'Banjar Dinas Telung Buana ','desa' => 'Sebudi','kecamatan' => 'Selat','kabupaten'=> 'Karangasem', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('villages')->insert($villages);
    }
}
