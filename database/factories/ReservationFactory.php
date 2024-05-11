<?php

namespace Database\Factories;

use App\Modules\Reservation\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Reservation>
 */
class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dateFrom = $this->faker->date();

        return [
            'date_from' => $dateFrom,
            'date_to' => $this->faker->date(max: $dateFrom),
        ];
    }
}
