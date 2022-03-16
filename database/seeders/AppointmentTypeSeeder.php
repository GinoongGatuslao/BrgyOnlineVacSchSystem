<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AppointmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('appointment_types')->insert(['name' => 'first_dose', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('appointment_types')->insert(['name' => 'second_dose', 'created_at' => now(), 'updated_at' => now()]);
    }
}
