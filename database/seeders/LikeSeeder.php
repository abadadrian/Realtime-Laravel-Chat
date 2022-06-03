<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add like
        DB::table('likes')->insert([
            'user_id' => 1,
            'image_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
