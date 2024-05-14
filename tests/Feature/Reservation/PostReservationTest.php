<?php

declare(strict_types=1);

namespace Tests\Feature\Reservation;

use App\Modules\Asset\Domain\Models\Asset;
use App\Modules\Reservation\Domain\DataTransferObjects\ReservationDatesDto;
use App\Modules\Reservation\Domain\Models\Reservation;
use App\Modules\Slot\Domain\Models\Slot;
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
        unset($data['asset_id']);
        $asset = Asset::factory()->create();

        $dates = (new ReservationDatesDto($data['date_from'], $data['date_to']))->getArrayOfDays();
        $totalPrice = 0;
        foreach ($dates as $date) {
            $slot = Slot::factory()
                ->for($asset)
                ->create(['date' => $date]);
            $totalPrice += $slot->price;
        }

        // when
        $response = $this->postJson('/api/reservations', $data);

        // then
        $response->assertSuccessful();
        $id = $response->json('data.id');
        $reservation = Reservation::find($id);
        $this->assertSame(2, $reservation->slots()->count());
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

    public function testCannotStoreForLessThanOneDay(): void
    {
        // given
        $data = [
            'date_from' => '2022-01-01',
            'date_to' => '2022-01-01',
        ];

        // when
        $response = $this->postJson('/api/reservations', $data);

        // then
        $response->assertUnprocessable();
        $response->assertJsonValidationErrors([
            'date_to' => [
                'The date to field must be a date after date from.',
            ],
        ]);
    }
}
