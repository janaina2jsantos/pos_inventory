<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'zip' => $this->faker->postcode(),
            'address' => $this->faker->streetName(),
            'number' => $this->faker->buildingNumber(),
            'neighborhood' => $this->faker->streetSuffix(),
            'city' => $this->faker->city(),
            'state' => $this->faker->stateAbbr(),
            'role' => $this->faker->jobTitle(),
            'experience' => $this->faker->numberBetween($min = 0, $max = 2) . '-' . $this->faker->numberBetween($min = 3, $max = 5) . ' years',
            'nid_no' => $this->faker->numerify('########'),
            'salary' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 10000),
            // 'vacation' => $this->faker->randomElement(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']),
            'vacation' => $this->faker->date($format = 'Y-m', $max = 'now'),
            'status' => $this->faker->boolean(),
        ];
    }
}
