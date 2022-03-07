<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User names: admin, user
        DB::table('users')->insert(['name' => 'Juanito C. Dela Cruz', 'email' => '', 'username' => 'administrator', 'password' => Hash::make('admin100'), 'user_type_id' => 1, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('personnel_information')->insert(['user_id' => 1, 'first_name' => 'Juanito', 'middle_name' => 'Carlos', 'last_name' => 'Dela Cruz', 'birthdate' => date_create('April 21, 1995'), 'sex' => 'male', 'address' => 'Purok Salukag, New Carmen, Tacurong', 'contact_number' => '09657258615', 'created_at' => now(), 'updated_at' => now()]);
    }
}
