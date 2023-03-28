<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'full_name' => fake()->name,
            'phone_number' => fake()->phoneNumber,
            'detail' => fake()->address,
            'patokan' => fake()->streetName,
            'latitude' => fake()->latitude,
            'longitude' => fake()->longitude,
            'accuracy' => fake()->numberBetween(0, 100),
        ];
    }
}
