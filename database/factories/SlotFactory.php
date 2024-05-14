<?php

namespace Database\Factories;

use App\Modules\Asset\Domain\Models\Asset;
use App\Modules\Slot\Domain\Models\Slot;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Slot>
 */
class SlotFactory extends Factory
{
    protected $model = Slot::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->date(),
            'price' => $this->faker->randomNumber(),
            'asset_id' => Asset::factory(),
            'reservation_id' => null,
        ];
    }
}
