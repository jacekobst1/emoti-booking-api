<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Modules\Asset\Domain\Models\Asset;
use App\Modules\Auth\Domain\Models\User;
use App\Modules\Reservation\Domain\Models\Reservation;
use Carbon\Carbon;
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
            'date_to' => Carbon::parse($dateFrom)->addDays(2)->toDateString(),
            'total_price' => $this->faker->randomNumber(),
            'user_id' => User::factory(),
            'asset_id' => Asset::factory(),
        ];
    }
}
