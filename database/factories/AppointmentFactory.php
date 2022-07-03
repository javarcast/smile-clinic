<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
           
            'date'          => $this->faker->dateTimeThisMonth(),
            'hour'          => '08:12:44',
            'total'         => $this->faker->randomElement([1,250,895,1540,4560]),
            'state_id'      => $this->faker->randomElement([1,2,3]),
            'dentist_id'    => 1,
            'patient_id'    => $this->faker->randomElement([1, 2])
        ];
    }
}
