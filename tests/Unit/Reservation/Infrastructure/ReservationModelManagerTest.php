<?php

declare(strict_types=1);

namespace Tests\Unit\Reservation\Infrastructure;

use App\Modules\Reservation\Domain\Models\Reservation;
use App\Modules\Reservation\Infrastructure\ReservationModelManager;
use Tests\TestCase;

final class ReservationModelManagerTest extends TestCase
{
    public function testNewInstance(): void
    {
        // given
        $properties = ['date_from' => '2022-01-01', 'date_to' => '2022-01-02', 'total_price' => 90000];
        $repository = $this->app->make(ReservationModelManager::class);

        // when
        $result = $repository->newInstance($properties);

        // then
        $this->assertInstanceOf(Reservation::class, $result);
        $this->assertEquals($properties['date_from'], $result->date_from);
        $this->assertEquals($properties['date_to'], $result->date_to);
        $this->assertNotEquals($properties['total_price'], $result->total_price); // not filled, because it's guarded
    }

    public function testSave(): void
    {
        // given
        $reservation = Reservation::factory()->make();
        $repository = $this->app->make(ReservationModelManager::class);

        // when
        $repository->save($reservation);

        // then
        $this->assertDatabaseHas('reservations', [
            'id' => $reservation->id,
            'date_from' => $reservation->date_from,
            'date_to' => $reservation->date_to,
            'total_price' => $reservation->total_price,
        ]);
    }
}
