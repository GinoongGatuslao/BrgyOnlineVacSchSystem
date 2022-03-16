<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PurokSeeder::class,
            UserTypeSeeder::class,
            UserSeeder::class,
            VaccineSeeder::class,
            AppointmentTypeSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
