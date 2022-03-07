<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PurokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Purok names: Sampaguita, Linglingay, Salukag, Malipayon, Ayat, Pagkakaisa, Saranay
        DB::table('puroks')->insert(['name' => 'Sampaguita', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('puroks')->insert(['name' => 'Linglingay', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('puroks')->insert(['name' => 'Salukag', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('puroks')->insert(['name' => 'Malipayon', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('puroks')->insert(['name' => 'Ayat', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('puroks')->insert(['name' => 'Pagkakaisa', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('puroks')->insert(['name' => 'Saranay', 'created_at' => now(), 'updated_at' => now()]);
    }
}
