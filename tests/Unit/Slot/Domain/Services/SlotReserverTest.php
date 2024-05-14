<?php

declare(strict_types=1);

namespace Tests\Unit\Slot\Domain\Services;

use App\Modules\Slot\Domain\Contracts\SlotModelManagerInterface;
use App\Modules\Slot\Domain\Services\SlotReserver;
use Mockery;
use Mockery\MockInterface;
use Str;
use Tests\TestCase;

final class SlotReserverTest extends TestCase
{
    public function testReserveSlots(): void
    {
        $reservationId = Str::uuid();
        $slotIds = [Str::uuid(), Str::uuid()];

        // mock
        $this->instance(
            SlotModelManagerInterface::class,
            Mockery::mock(SlotModelManagerInterface::class, function (MockInterface $mock) {
                $mock->shouldReceive('reserveSlots')
                    ->once()
                    ->andReturnNull();
            })
        );

        // given
        $slotReserver = $this->app->make(SlotReserver::class);

        // when
        $slotReserver->reserveSlots($reservationId, $slotIds);
    }
}
