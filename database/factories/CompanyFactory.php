<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'        => fake()->company(),
            'nip'         => fake()->numberBetween(1000000000),
            'address'     => fake()->address(),
            'city'        => fake()->city(),
            'postal_code' => '12-123',
        ];
    }
}
