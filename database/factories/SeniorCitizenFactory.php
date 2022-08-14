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

            // personal information
            'lastname' => $this->faker->lastName(),
            'firstname' => $this->faker->firstName(),
            'middlename' => $this->faker->lastname(),
            'gender'  => $this->faker->randomElement(['male', 'female']),
            'age' => $this->faker->numberBetween(60, 100),
            'birthdate' => $this->faker->date(),
            'birthplace' => $this->faker->city(),
            'picture' => '9ZT72TmsPQz49BG7URBnNOooKxMEshsckJMVG8qV.jpg',

            // contact information
            'phone_number' => $this->faker->numerify('09#########'),
            'email' => $this->faker->email(),

            // location details
            'barangay' => Barangay::all()->random()->id,
            'province' => $this->faker->city(),
            'years_of_stay' => $this->faker->numberBetween(1, 60),

            // other information
            'religion' => $this->faker->word(),
            'marital_status' => $this->faker->randomElement(['unmarried', 'married', 'divorced', 'widowed']),
            'educational_attainment' => $this->faker->word(),
            'status' => $this->faker->randomElement(['acitve', 'deceased']),

            // emergency details
            'emergency_contact_person' => $this->faker->name(),
            'emergency_contact_number' => $this->faker->numerify('09#########'),
            'emergency_contact_address' => $this->faker->address(),
        ];
    }
}
