<?php

declare(strict_types=1);

namespace App\Modules\Slot\Infrastructure;

use App\Modules\Slot\Domain\Contracts\SlotModelManagerInterface;
use App\Modules\Slot\Domain\Models\Slot;
use Ramsey\Uuid\UuidInterface;

final readonly class SlotModelManager implements SlotModelManagerInterface
{
    public function __construct(private Slot $model)
    {
    }

    /**
     * @param list<UuidInterface> $slotIds
     */
    public function reserveSlots(UuidInterface $reservationId, array $slotIds): void
    {
        $slotIdsStrings = array_map(
            static fn(UuidInterface $slotId): string => $slotId->toString(),
            $slotIds,
        );

        $this->model
            ->whereIn('id', $slotIdsStrings)
            ->update(['reservation_id' => $reservationId]);
    }
}
