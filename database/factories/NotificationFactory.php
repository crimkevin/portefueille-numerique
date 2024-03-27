<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'libNotif' => fake()->text($max = 100),
            'dateNotif' => fake()->date($format = 'y-m-d',$max ='now'),
            'user_id' =>fake()->randomDigitNot(5) ,
        ];
    }
}
