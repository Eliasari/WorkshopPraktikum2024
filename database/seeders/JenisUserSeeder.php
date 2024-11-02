<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        DB::table('jenis_user')->insert([
            ['jenis_user' => 'Admin', 'create_by' => 'system'],
            ['jenis_user' => 'User', 'create_by' => 'system'],
            ['jenis_user' => 'Mahasiswa', 'create_by' => 'system'],
        ]);
    }
}
