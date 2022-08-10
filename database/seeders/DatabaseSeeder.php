<?php

namespace Database\Seeders;

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
        \App\Models\User::factory(1)->create();
        for ($i = 0; $i < 225; $i++) {
            \App\Models\Barangay::factory()->create();
        }
        \App\Models\SeniorCitizen::factory(120)->create();
    }
}
