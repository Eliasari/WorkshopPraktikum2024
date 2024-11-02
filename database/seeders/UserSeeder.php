<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user')->insert([
            'nama_user' => 'Admin2',
            'username' => 'Admin2',
            'password' => bcrypt('password'),
            'email' => 'admin2@gmail.com',
            'no_hp' => '123456789',
            'id_jenis_user' => 1,
            'create_by' => 'system'
        ]);
    }
}
