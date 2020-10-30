<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Test User',
            'username' => 'testUser',
            'email' => 'test@test.c',
            'password' => Hash::make('123456789')
        ]);

        DB::table('users')->insert([
            'name' => 'Test User2',
            'username' => 'testUser2',
            'email' => 'test2@test.c',
            'password' => Hash::make('123456789')
        ]);
    }
}
