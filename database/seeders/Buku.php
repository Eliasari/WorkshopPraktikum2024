<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Buku extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('buku')->insert([
            [
                'kategori_id' => 1, // Novel
                'kode' => 'NV-01',
                'judul' => 'Home Sweet Loan',
                'pengarang' => 'Almira Bastari',
            ],
            [
                'kategori_id' => 2, // Biografi
                'kode' => 'BO-01',
                'judul' => 'Mohammad Hatta Untuk Negeriku',
                'pengarang' => 'Taufik Abdullah',
            ],
            [
                'kategori_id' => 1, // Novel
                'kode' => 'NV-02',
                'judul' => 'Keajaiban Toko Kelontong Namiya',
                'pengarang' => 'Keigo Higashino',
            ],
        ]);
    }
    }

