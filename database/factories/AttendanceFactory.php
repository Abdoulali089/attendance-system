<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $checkIn = fake()->dateTimeBetween('-1 month', 'now');
        $checkOut = (clone $checkIn)->modify('+' . rand(4, 9) . ' hours');

        return [
            'employee_id' => \App\Models\Employee::factory(),
            'date' => $checkIn->format('Y-m-d'),
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'status' => 'present',
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
