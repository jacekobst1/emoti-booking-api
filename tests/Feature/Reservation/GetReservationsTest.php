<?php

declare(strict_types=1);

namespace Tests\Feature\Reservation;

use App\Modules\Reservation\Reservation;
use Tests\Helpers\SanctumTrait;
use Tests\TestCase;

final class GetReservationsTest extends TestCase
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
        Reservation::factory()->create();

        // when
        $response = $this->getJson('/api/reservations');

        // then
        $response->assertSuccessful();
        $response->assertJsonCount(1, 'data');
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'date_from',
                    'date_to',
                    'created_at',
                    'updated_at',
                ],
            ],
        ]);
    }

    public function testReservationsAreSortedByDates(): void
    {
        // given
        $reservation4 = Reservation::factory()->create([
            'date_from' => '2020-01-02',
            'date_to' => '2020-01-04',
        ]);
        $reservation2 = Reservation::factory()->create([
            'date_from' => '2020-01-01',
            'date_to' => '2020-01-03',
        ]);
        $reservation5 = Reservation::factory()->create([
            'date_from' => '2020-01-02',
            'date_to' => '2020-01-05',
        ]);
        $reservation3 = Reservation::factory()->create([
            'date_from' => '2020-01-01',
            'date_to' => '2020-01-04',
        ]);
        $reservation1 = Reservation::factory()->create([
            'date_from' => '2020-01-01',
            'date_to' => '2020-01-02',
        ]);

        // when
        $response = $this->getJson('/api/reservations');

        // then
        $response->assertSuccessful();
        $response->assertJsonCount(5, 'data');
        $this->assertSame($reservation1->id->toString(), $response->json('data.0.id'));
        $this->assertSame($reservation2->id->toString(), $response->json('data.1.id'));
        $this->assertSame($reservation3->id->toString(), $response->json('data.2.id'));
        $this->assertSame($reservation4->id->toString(), $response->json('data.3.id'));
        $this->assertSame($reservation5->id->toString(), $response->json('data.4.id'));
    }
}
