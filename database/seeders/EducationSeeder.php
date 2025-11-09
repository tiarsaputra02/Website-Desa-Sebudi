<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $education = [
            ['strata_pendidikan' => 'Tidak / Belum Sekolah', 'created_at' => now(), 'updated_at' => now()],
            ['strata_pendidikan' => 'Belum Tamat SD / Sederajat', 'created_at' => now(), 'updated_at' => now()],
            ['strata_pendidikan' => 'SD / Sederajat', 'created_at' => now(), 'updated_at' => now()],
            ['strata_pendidikan' => 'SMP / Sederajat', 'created_at' => now(), 'updated_at' => now()],
            ['strata_pendidikan' => 'SMA / Sederajat', 'created_at' => now(), 'updated_at' => now()],
            ['strata_pendidikan' => 'D1', 'created_at' => now(), 'updated_at' => now()],
            ['strata_pendidikan' => 'D2', 'created_at' => now(), 'updated_at' => now()],
            ['strata_pendidikan' => 'D3', 'created_at' => now(), 'updated_at' => now()],
            ['strata_pendidikan' => 'D4 / S1', 'created_at' => now(), 'updated_at' => now()],
            ['strata_pendidikan' => 'S2', 'created_at' => now(), 'updated_at' => now()],
            ['strata_pendidikan' => 'S3', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('education_levels')->insert($education);
    }
}
