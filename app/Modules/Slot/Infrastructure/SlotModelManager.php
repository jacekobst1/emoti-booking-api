<?php

declare(strict_types=1);

namespace App\Modules\Slot\Infrastructure;

use App\Modules\Slot\Domain\Contracts\SlotModelManagerInterface;
use App\Modules\Slot\Domain\Models\Slot;
use Ramsey\Uuid\UuidInterface;

final readonly class SlotModelManager implements SlotModelManagerInterface
{
    public function __construct (private Slot $model)
    {
    }

    public function reserveSlots(UuidInterface $reservationId, array $slotIds): void
    {
        $this->model
            ->whereIn('id', $slotIds)
            ->update(['reservation_id' => $reservationId]);
    }
}
