<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Domain\Services\SlotsFinder;

use App\Modules\Slot\Domain\Contracts\DataTransferObjects\SlotDtoCollection;
use App\Modules\Slot\Domain\Contracts\SlotGetterInterface;
use Ramsey\Uuid\UuidInterface;

final readonly class AssetSlotsFinder implements SlotsFinderInterface
{
    public function __construct(
        private SlotGetterInterface $slotGetter,
        private UuidInterface $assetId,
    ) {
    }

    /**
     * We want to return dates only if there is uninterrupted sequence of free slots, day by day.
     * That's why we're checking if the number of slots is equal to the number of dates.
     *
     * @param non-empty-list<non-empty-string> $dates
     */
    public function findByDates(array $dates): ?SlotDtoCollection
    {
        $slots = $this->slotGetter->getFreeAssetSlotsByDates($this->assetId, $dates);

        return $slots->count() === count($dates)
            ? $slots
            : null;
    }

}
