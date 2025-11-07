<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EmpeloyeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $empeloyees = [
            ['fullname' => 'I Nyoman Tinggal','email' => 'sebudi1@email.com','phone_number' =>'082341103333','role_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['fullname' => 'I Komang Gede','email' => 'sebudi2@email.com','phone_number' =>'082341103455','role_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['fullname' => 'I Nyoman Muliarta','email' => 'sebudi3@email.com','phone_number' =>'081338912353','role_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['fullname' => 'I Putu Tangkas Udiawan','email' => 'sebudi4@email.com','phone_number' =>'082339556455','role_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['fullname' => 'I Made Berata','email' => 'sebudi5@email.com','phone_number' =>'085237041002','role_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['fullname' => 'I Gede Suyasa','email' => 'sebudi6@email.com','phone_number' =>'082237827454','role_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['fullname' => 'I Putu Kertiyasa','email' => 'sebudi7@email.com','phone_number' =>'082237827454','role_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['fullname' => 'I Wayan Darsana','email' => 'sebudi8@email.com','phone_number' =>'082341342369','role_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['fullname' => 'I Komang Budi Artiawan','email' => 'sebudi9@email.com','phone_number' =>'082144948067','role_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['fullname' => 'I Wayan Ardana','email' => 'sebudi10@email.com','phone_number' =>'082341666555','role_id' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['fullname' => 'I Gede Wenten','email' => 'sebudi11@email.com','phone_number' =>'08520553344','role_id' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['fullname' => 'I Made Madya ','email' => 'sebudi12@email.com','phone_number' =>'08520553344','role_id' => 12, 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('empeloyees')->insert($empeloyees);
    }
}
