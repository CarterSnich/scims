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

        $is_delisted = $this->faker->boolean();

        $date_of_birth = new Carbon($this->faker->dateTimeBetween('-120 years', '-60 years'));
        $age = $date_of_birth->age;

        return [

            // personal information
            'lastname' => $this->faker->lastName(),
            'firstname' => $this->faker->firstName(),
            'middlename' => $this->faker->randomElement([$this->faker->lastName(), null]),

            // location details
            'barangay' => Barangay::all()->random()->id,
            'province' => $this->faker->city(),

            // other details
            'birthdate' => $this->faker->date('Y-m-d', $date_of_birth),
            'age' => $age,
            'marital_status' => $this->faker->randomElement(['unmarried', 'married', 'divorced', 'widowed']),

            // picture
            'picture' => $this->faker->randomElement([
                '9ZT72TmsPQz49BG7URBnNOooKxMEshsckJMVG8qV.jpg',
                'ak3IIHyeCttxZcqsm1RG2MDvWfAjryMWlsxeMqfa.jpg',
                'IG7iutu63VuWX5DOp6IIbSnjGOJbYqXyqIvgJeB0.jpg',
                'JPQk5sTzoBWyy6XjJXyN3Mc2pK1frH60IWXE6Eh0.jpg',
                'LRCvCuK9g5anafymge20m15QcKL5swfUwty8t4St.jpg',
                'XYLDFrOsrFzloCpsbYd9x84AtKVWEeo4MWuinlqk.jpg',
                'mGIs4wF7jaiEeoEl8HY3yob4KFLpnfz90Xtmahii.png',
                'rZDnAnTC75vMseeStntbRbD82dCGKaN7nOWae1NX.png'
            ]),

            // delist details
            'is_delisted' => $is_delisted,
            'delist_reason' => $is_delisted ? $this->faker->paragraph(3, true) : null
        ];
    }
}
