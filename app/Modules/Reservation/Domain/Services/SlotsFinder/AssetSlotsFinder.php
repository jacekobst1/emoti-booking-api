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

    public function findByDates(array $dates): ?SlotDtoCollection
    {
        $slots = $this->slotGetter->getFreeAssetSlotsByDates($this->assetId, $dates);

        return $slots->count() === count($dates)
            ? $slots
            : null;
    }

}
