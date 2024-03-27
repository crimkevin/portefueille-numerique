<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\transaction>
 */
class transactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amountTransaction' =>fake()->randomDigit(),
            'statue' => fake()->randomElement(['debited', 'credited','transfer']),
            'dateTransaction' => fake()->date(),
            'senderName' => fake()->name(),
            'receiverName'=> fake()->name(),
            'refTransaction'=> fake()->stateAbbr(),
            'PaymentMethod'=>fake()->creditCardNumber(),
            'user_id'=> round(1,20)
            
        ];
    }
}
