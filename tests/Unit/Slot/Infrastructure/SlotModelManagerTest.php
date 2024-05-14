<?php

declare(strict_types=1);

namespace Tests\Unit\Slot\Infrastructure;

use App\Modules\Reservation\Domain\Models\Reservation;
use App\Modules\Slot\Domain\Models\Slot;
use App\Modules\Slot\Infrastructure\SlotModelManager;
use Tests\TestCase;

final class SlotModelManagerTest extends TestCase
{
    public function testReserveSlots(): void
    {
        //given
        $reservationId = Reservation::factory()->create()->id;
        $slots = Slot::factory()->count(3)->create();
        $slotIds = $slots->pluck('id')->toArray();
        $slotModelManager = $this->app->make(SlotModelManager::class);

        //when
        $slotModelManager->reserveSlots($reservationId, $slotIds);

        //then
        $this->assertDatabaseHas('slots', [
            'id' => $slotIds[0],
            'reservation_id' => $reservationId,
        ]);
        $this->assertDatabaseHas('slots', [
            'id' => $slotIds[1],
            'reservation_id' => $reservationId,
        ]);
        $this->assertDatabaseHas('slots', [
            'id' => $slotIds[2],
            'reservation_id' => $reservationId,
        ]);
    }
}
