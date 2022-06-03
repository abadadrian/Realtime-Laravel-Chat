<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Add comment
        DB::table('comments')->insert([
            'user_id' => 1,
            'image_id' => 1,
            'comment' => 'This is a test comment',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
