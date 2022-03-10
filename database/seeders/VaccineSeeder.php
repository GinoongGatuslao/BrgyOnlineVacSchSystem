<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VaccineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vaccines')->insert([
                                    [
                                    'vaccine_name' => 'Pfizer',
                                    'dose' => '2',
                                    'second_dose_sched' => '21',
                                    ],
                                    [
                                    'vaccine_name' => 'Sinovac',
                                    'dose' => '2',
                                    'second_dose_sched' => '30',
                                    ],
                                    [
                                    'vaccine_name' => 'Jensen',
                                    'dose' => '1',
                                    'second_dose_sched' => '0',
                                    ],
                                    [
                                    'vaccine_name' => 'Moderna',
                                    'dose' => '2',
                                    'second_dose_sched' => '30',
                                    ]
                        
                                    ]);                              
    }
}
