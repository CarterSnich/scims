<?php

namespace Database\Factories;

use App\Models\Barangay;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeniorCitizenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $age = $this->faker->numberBetween(60, 120);
        $bday =  Carbon::now()->subYears($age);

        return [
            // identification details
            'lastname' => $this->faker->lastName(),
            'firstname' => $this->faker->firstName(),
            'middlename' => $this->faker->randomElement(['', $this->faker->lastName()]),

            // location details
            'barangay' => Barangay::all()->random()->id,
            'province' => $this->faker->city(),

            // other information
            'birthdate' => $bday,
            'age' => $age,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'marital_status' => $this->faker->randomElement(['unmarried', 'married', 'divorced', 'widowed']),
            'picture' => '5a437fa9c13d3_thumb900.jpg'
        ];
    }
}
