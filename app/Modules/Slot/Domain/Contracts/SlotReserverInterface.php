<?php

declare(strict_types=1);

namespace App\Modules\Slot\Domain\Contracts;

use Ramsey\Uuid\UuidInterface;

interface SlotReserverInterface
{
    /**
     * @param list<UuidInterface> $slotIds
     */
    public function reserveSlots(UuidInterface $reservationId, array $slotIds): void;
}
