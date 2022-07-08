<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AppointmentTreatmentSeeder>
 */
class AppointmentTreatmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'price' => $this->faker->randomElement([1,250,895,1540,4560]),
            'observation' => 'Lorem Ipsum Dolor atmet',
            'appointment_id' => $this->faker->numberBetween(1,50),
            'treatment_id' => $this->faker->numberBetween(1,10)
        ];
    }
}
