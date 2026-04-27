<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Barangay;
use App\Models\Family;
use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create 5 barangays
        Barangay::factory(5)->create();

        // Create 10 families with patients
        Family::factory(10)
            ->has(Patient::factory()->count(3), 'patients')
            ->create();

        // Create additional 15 patients
        Patient::factory(15)->create();
    }
}
