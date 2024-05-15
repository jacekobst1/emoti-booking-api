<?php

declare(strict_types=1);

namespace Tests\Unit\Reservation\Domain\Services;

use App\Modules\Reservation\Domain\Contracts\ReservationModelManagerInterface;
use App\Modules\Reservation\Domain\Models\Reservation;
use App\Modules\Reservation\Domain\Services\ReservationDestroyer;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

final class ReservationDestroyerTest extends TestCase
{
    public function testDelete(): void
    {
        $reservation = Reservation::factory()->make();

        // mock
        $this->instance(
            ReservationModelManagerInterface::class,
            Mockery::mock(ReservationModelManagerInterface::class, function (MockInterface $mock) use ($reservation) {
                $mock->shouldReceive('delete')
                    ->once()
                    ->with($reservation)
                    ->andReturnNull();
            })
        );

        // given
        $destroyer = $this->app->make(ReservationDestroyer::class);

        // when
        $destroyer->delete($reservation);
    }
}
