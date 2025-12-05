<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AssistanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $assistance_types = [
            ['jenis_bantuan' => 'Program Keluarga Harapan (PKH)', 'created_at' => now(), 'updated_at' => now()],
            ['jenis_bantuan' => 'Bantuan Pangan Non Tunai (BPNT) / Sembako', 'created_at' => now(), 'updated_at' => now()],
            ['jenis_bantuan' => 'Bantuan Langsung Tunai (BLT) Dana Desa', 'created_at' => now(), 'updated_at' => now()],
            ['jenis_bantuan' => 'Bantuan Sosial Tunai (BST)', 'created_at' => now(), 'updated_at' => now()],
            ['jenis_bantuan' => 'Kartu Indonesia Sehat (KIS)', 'created_at' => now(), 'updated_at' => now()],
            ['jenis_bantuan' => 'Kartu Indonesia Pintar (KIP)', 'created_at' => now(), 'updated_at' => now()],
            ['jenis_bantuan' => 'Kartu Prakerja', 'created_at' => now(), 'updated_at' => now()],
            ['jenis_bantuan' => 'Program Rumah Tidak Layak Huni (RTLH)', 'created_at' => now(), 'updated_at' => now()],
            ['jenis_bantuan' => 'Bantuan Usaha Mikro (UMKM)', 'created_at' => now(), 'updated_at' => now()],
            ['jenis_bantuan' => 'Bantuan Sosial Disabilitas', 'created_at' => now(), 'updated_at' => now()],
            ['jenis_bantuan' => 'Bantuan Lansia', 'created_at' => now(), 'updated_at' => now()],
            ['jenis_bantuan' => 'Bantuan Pendidikan Anak Sekolah', 'created_at' => now(), 'updated_at' => now()],
            ['jenis_bantuan' => 'Bantuan Pangan Desa / Raskin', 'created_at' => now(), 'updated_at' => now()],
            ['jenis_bantuan' => 'Program Indonesia Pintar (PIP)', 'created_at' => now(), 'updated_at' => now()],
            ['jenis_bantuan' => 'Bantuan COVID-19', 'created_at' => now(), 'updated_at' => now()],
            ['jenis_bantuan' => 'Bantuan Bedah Rumah', 'created_at' => now(), 'updated_at' => now()],
            ['jenis_bantuan' => 'Bantuan Anak Yatim Piatu', 'created_at' => now(), 'updated_at' => now()],
            ['jenis_bantuan' => 'Bantuan Korban Bencana Alam', 'created_at' => now(), 'updated_at' => now()],
            ['jenis_bantuan' => 'Bantuan Sosial Lainnya', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('assistance_types')->insert($assistance_types);
    }
}
