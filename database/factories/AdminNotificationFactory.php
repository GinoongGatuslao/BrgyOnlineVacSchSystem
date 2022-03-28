<?php

namespace Database\Factories;

use App\Models\AdminNotification;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminNotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = AdminNotification::class;
    public function definition()
    {
        return [
            'message'=>$this->faker->sentence,
            'user_id'=>1,
            'appointment_date_id'=>1,
            'seen'=>0,
        ];
    }
}
