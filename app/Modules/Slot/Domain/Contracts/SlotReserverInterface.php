<?php

declare(strict_types=1);

namespace App\Modules\Slot\Domain\Contracts;

use Ramsey\Uuid\UuidInterface;

interface SlotReserverInterface
{
    public function reserveSlots(UuidInterface $reservationId, array $slotIds): void;
}
