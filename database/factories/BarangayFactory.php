<?php

namespace Database\Factories;

use Faker\Provider\bg_BG\PhoneNumber;
use Illuminate\Database\Eloquent\Factories\Factory;

class BarangayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'barangay_name' => $this->faker->unique()->lastName(),
            'contact_person' => $this->faker->name(),
            'contact_no' => $this->faker->numerify('09#########'),
            'email' => $this->faker->email()
        ];
    }
}
