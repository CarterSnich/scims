<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // return [
        //     'email' => $this->faker->email(),
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'name' => $this->faker->name(),
        //     'type' => $this->faker->randomElement(['admin', 'staff'])
        // ];


        return [
            'email' => 'admin@scims.org.ph',
            'password' => Hash::make('admin'),
            'name' => 'administrator',
            'type' => 'admin'
        ];
    }
}
