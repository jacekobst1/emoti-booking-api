<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Domain\Services\SlotsFinder;

use App\Modules\Slot\Domain\Contracts\DataTransferObjects\SlotDtoCollection;
use App\Modules\Slot\Domain\Contracts\SlotGetterInterface;
use Illuminate\Support\Collection;

final readonly class RandomSlotsFinder implements SlotsFinderInterface
{
    public function __construct(private SlotGetterInterface $slotGetter)
    {
    }

    public function findByDates(array $dates): ?SlotDtoCollection
    {
        /** @var Collection<int, SlotDtoCollection> $freeSlotsGroupedByAsset */
        $freeSlotsGroupedByAsset = $this->slotGetter->getFreeSlotsByDates($dates)->groupByAssetId();

        return $freeSlotsGroupedByAsset->first(
            static fn(SlotDtoCollection $slots): bool => $slots->count() === count($dates)
        );
    }
}
