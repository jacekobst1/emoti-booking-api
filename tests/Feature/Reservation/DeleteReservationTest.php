<?php

declare(strict_types=1);

namespace Tests\Feature\Reservation;

use App\Modules\Reservation\Domain\Models\Reservation;
use Tests\Helpers\SanctumTrait;
use Tests\TestCase;

final class DeleteReservationTest extends TestCase
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
        $reservation = Reservation::factory()->create([
            'user_id' => $this->loggedUser->id,
        ]);

        // when
        $response = $this->delete('/api/v1/reservations/' . $reservation->id->toString());

        // then
        $response->assertSuccessful();
        $this->assertDatabaseMissing('reservations', [
            'id' => $reservation->id->toString(),
        ]);
    }

    public function testCannotDeleteReservationOfAnotherUser(): void
    {
        // given
        $reservation = Reservation::factory()->create();

        // when
        $response = $this->delete('/api/v1/reservations/' . $reservation->id->toString());

        // then
        $response->assertForbidden();
    }
}
