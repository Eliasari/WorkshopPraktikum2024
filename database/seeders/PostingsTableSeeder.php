<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = DB::table('user')->pluck('id_user')->toArray();

        foreach ($userIds as $userId) {
            DB::table('postings')->insert([
                'sender' => $userId,
                'message_text' => Str::random(50),
                'message_gambar' => null,
                'create_by' => $userId,
                'create_date' => now(),
                'delete_mark' => '0',
                'update_by' => null,
                'update_date' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
