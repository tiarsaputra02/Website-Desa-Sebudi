<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProfesionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $profesions = [
            ['pekerjaan' => 'Belum / Tidak Bekerja', 'created_at' => now(), 'updated_at' => now()],
            ['pekerjaan' => 'Mengurus Rumah Tangga', 'created_at' => now(), 'updated_at' => now()],
            ['pekerjaan' => 'Pelajar / Mahasiswa', 'created_at' => now(), 'updated_at' => now()],
            ['pekerjaan' => 'Pensiunan', 'created_at' => now(), 'updated_at' => now()],
            ['pekerjaan' => 'Pegawai Negeri Sipil (PNS)', 'created_at' => now(), 'updated_at' => now()],
            ['pekerjaan' => 'TNI', 'created_at' => now(), 'updated_at' => now()],
            ['pekerjaan' => 'POLRI', 'created_at' => now(), 'updated_at' => now()],
            ['pekerjaan' => 'Petani / Pekebun', 'created_at' => now(), 'updated_at' => now()],
            ['pekerjaan' => 'Peternak', 'created_at' => now(), 'updated_at' => now()],
            ['pekerjaan' => 'Nelayan', 'created_at' => now(), 'updated_at' => now()],
            ['pekerjaan' => 'Pedagang', 'created_at' => now(), 'updated_at' => now()],
            ['pekerjaan' => 'Karyawan Swasta', 'created_at' => now(), 'updated_at' => now()],
            ['pekerjaan' => 'Wirausaha', 'created_at' => now(), 'updated_at' => now()],
            ['pekerjaan' => 'Guru', 'created_at' => now(), 'updated_at' => now()],
            ['pekerjaan' => 'Perangkat Desa', 'created_at' => now(), 'updated_at' => now()],
            ['pekerjaan' => 'Kepala Desa', 'created_at' => now(), 'updated_at' => now()],
            ['pekerjaan' => 'Buruh Harian Lepas', 'created_at' => now(), 'updated_at' => now()],
            ['pekerjaan' => 'Tukang Bangunan', 'created_at' => now(), 'updated_at' => now()],
            ['pekerjaan' => 'Sopir', 'created_at' => now(), 'updated_at' => now()],
            ['pekerjaan' => 'Dokter', 'created_at' => now(), 'updated_at' => now()],
            ['pekerjaan' => 'Perawat', 'created_at' => now(), 'updated_at' => now()],
            ['pekerjaan' => 'Bidan', 'created_at' => now(), 'updated_at' => now()],
            ['pekerjaan' => 'Seniman / Artis', 'created_at' => now(), 'updated_at' => now()],
            ['pekerjaan' => 'Lainnya', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('profesions')->insert($profesions);
    }
}
