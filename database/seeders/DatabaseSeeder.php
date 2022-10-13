<?php

namespace Database\Seeders;

use Database\Factories\AdministratorFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // // user
        // for ($i = 0; $i < 6; $i++) {
        //     \App\Models\User::factory()->create();
        // }

        // single user
        \App\Models\User::factory()->create();


        // barangays
        // for ($i = 0; $i < 225; $i++) {
        //     \App\Models\Barangay::factory()->create();
        // }

        // senior citizens
        // \App\Models\SeniorCitizen::factory(120)->create();
    }
}
