<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Company;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'       => fake()->firstName(),
            'surname'    => fake()->lastName(),
            'email'      => fake()->email(),
            'phone'      => fake()->e164PhoneNumber(),
            'company_id' => Company::factory()->create()->id,
        ];
    }
}
