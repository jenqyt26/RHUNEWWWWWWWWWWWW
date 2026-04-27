<?php

namespace Database\Factories;

use App\Models\Family;
use App\Models\Barangay;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Family>
 */
class FamilyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'family_name' => fake()->lastName() . ' Family',
            'barangay_id' => Barangay::factory(),
        ];
    }
}
