<?php

namespace Database\Factories;

use App\Modules\Vacant\Vacant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Vacant>
 */
class VacantFactory extends Factory
{
    protected $model = Vacant::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->date(),
            'number_of_beds' => $this->faker->numberBetween(0, 10),
        ];
    }
}
