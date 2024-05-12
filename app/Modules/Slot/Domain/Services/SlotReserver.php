<?php

declare(strict_types=1);

namespace App\Modules\Slot\Domain\Services;

use App\Modules\Slot\Domain\Contracts\SlotReserverInterface;
use App\Modules\Slot\Infrastructure\SlotModelManager;
use Ramsey\Uuid\UuidInterface;

final readonly class SlotReserver implements SlotReserverInterface
{
    public function __construct(private SlotModelManager $manager)
    {
    }

    public function reserveSlots(UuidInterface $reservationId, array $slotIds): void
    {
        $this->manager->reserveSlots($reservationId, $slotIds);
    }
}
