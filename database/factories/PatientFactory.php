<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\Family;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_name' => fake()->name(),
            'family_id' => Family::factory(),
            'birthdate' => fake()->dateTimeBetween('-80 years', '-1 years'),
            'sex' => fake()->randomElement(['Male', 'Female']),
            'contact_number' => fake()->phoneNumber(),
        ];
    }
}
