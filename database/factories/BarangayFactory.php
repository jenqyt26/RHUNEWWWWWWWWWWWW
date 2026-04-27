<?php

namespace Database\Factories;

use App\Models\Barangay;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Barangay>
 */
class BarangayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $barangays = [
            'Barangay 1',
            'Barangay 2',
            'Barangay 3',
            'Barangay 4',
            'Barangay 5',
            'Poblacion',
            'San Vicente',
            'San Isidro',
            'Santa Cruz',
            'Mahabang Parang',
        ];

        return [
            'barangay_name' => fake()->randomElement($barangays),
        ];
    }
}
