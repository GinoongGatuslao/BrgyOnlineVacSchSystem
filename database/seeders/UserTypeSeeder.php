<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User types: Admin, User
        DB::table('user_types')->insert(['name' => 'Admin', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('user_types')->insert(['name' => 'User', 'created_at' => now(), 'updated_at' => now()]);
    }
}
