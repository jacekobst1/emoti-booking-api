<?php

declare(strict_types=1);

namespace Tests\Feature\Reservation;

use App\Modules\Reservation\Domain\Models\Reservation;
use Tests\Helpers\SanctumTrait;
use Tests\TestCase;

final class GetAdminReservationsTest extends TestCase
{
    use SanctumTrait;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actAsAdmin();
    }

    public function testSuccess(): void
    {
        // given
        Reservation::factory()->create();

        // when
        $response = $this->getJson('/api/v1/admin/reservations');

        // then
        $response->assertSuccessful();
        $response->assertJsonCount(1, 'data');
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'user_id',
                    'date_from',
                    'date_to',
                    'created_at',
                    'updated_at',
                ],
            ],
        ]);
    }
}
