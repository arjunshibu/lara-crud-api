<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'title' => 'Test Post',
            'body' => 'test body',
            'author' => 1
        ]);

        DB::table('posts')->insert([
            'title' => 'Test Post 2',
            'body' => 'test body 2',
            'author' => 2
        ]);
    }
}
