<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Kategori extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori')->insert([
            ['nama' => 'Novel'],
            ['nama' => 'Biografi'],
            ['nama' => 'Komik'],
        ]);
    }
}
