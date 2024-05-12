<?php

declare(strict_types=1);

namespace Tests\Feature\Reservation;

use App\Modules\Reservation\Reservation;
use App\Modules\Vacant\Vacant;
use Carbon\CarbonPeriod;
use Tests\Helpers\SanctumTrait;
use Tests\TestCase;

final class PostReservationTest extends TestCase
{
    use SanctumTrait;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actAsUser();
    }

    public function testSuccess(): void
    {
        // given
        $data = Reservation::factory()->make([
            'date_from' => '2022-01-01',
            'date_to' => '2022-01-03',
        ])->toArray();

        $period = CarbonPeriod::create($data['date_from'], $data['date_to'])->toArray();
        array_pop($period);
        $totalPrice = 0;
        foreach ($period as $date) {
            $vacant = Vacant::factory()->create(['date' => $date->toDateString()]);
            $totalPrice += $vacant->price;
        }

        // when
        $response = $this->postJson('/api/reservations', $data);

        // then
        $response->assertSuccessful();
        $id = $response->json('data.id');
        $reservation = Reservation::find($id);
        $this->assertSame(2, $reservation->vacancies()->count());
        $this->assertSame($totalPrice, $reservation->total_price);
    }

    public function testErrorOnWrongPayload(): void
    {
        // given
        $data = [
            'date_from' => 555,
        ];

        // when
        $response = $this->postJson('/api/reservations', $data);

        // then
        $response->assertUnprocessable();
        $response->assertJsonValidationErrors([
            'date_from' => [
                'The date from field must be a string.',
                'The date from field must be a valid date.',
            ],
            'date_to' => [
                'The date to field is required.',
            ],
        ]);
    }
}
