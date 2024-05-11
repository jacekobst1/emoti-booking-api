<?php

declare(strict_types=1);

namespace Tests\Feature\Reservation;

use App\Modules\Reservation\Reservation;
use Tests\TestCase;

final class PostReservationTest extends TestCase
{
    public function testSuccess(): void
    {
        // given
        $data = Reservation::factory()->make()->toArray();

        // when
        $response = $this->postJson('/api/reservations', $data);

        // then
        $response->assertSuccessful();
        $id = $response->json('data.id');
        $this->assertDatabaseHas('reservations', ['id' => $id] + $data);
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
