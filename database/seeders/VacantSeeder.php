<?php

namespace Database\Seeders;

use App\Modules\Vacant\Vacant;
use Illuminate\Database\Seeder;

class VacantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vacant::factory()->create(['date' => '2024-06-01', 'number_of_beds' => 5]);
        Vacant::factory()->create(['date' => '2024-06-02', 'number_of_beds' => 5]);
        Vacant::factory()->create(['date' => '2024-06-03', 'number_of_beds' => 5]);
        Vacant::factory()->create(['date' => '2024-06-04', 'number_of_beds' => 5]);
        Vacant::factory()->create(['date' => '2024-06-05', 'number_of_beds' => 5]);

        Vacant::factory()->create(['date' => '2024-06-06', 'number_of_beds' => 0]);

        Vacant::factory()->create(['date' => '2024-06-07', 'number_of_beds' => 5]);

        Vacant::factory()->create(['date' => '2024-06-08', 'number_of_beds' => 4]);
        Vacant::factory()->create(['date' => '2024-06-09', 'number_of_beds' => 4]);
        Vacant::factory()->create(['date' => '2024-06-10', 'number_of_beds' => 4]);
    }
}
