<?php

declare(strict_types=1);

namespace App\Modules\Slot\Domain\Services;

use App\Modules\Slot\Domain\Contracts\DataTransferObjects\SlotDtoCollection;
use App\Modules\Slot\Domain\Contracts\SlotGetterInterface;
use App\Modules\Slot\Domain\Contracts\SlotRepositoryInterface;
use Ramsey\Uuid\UuidInterface;

final readonly class SlotGetter implements SlotGetterInterface
{
    public function __construct(private SlotRepositoryInterface $slotRepository)
    {
    }

    public function getFreeSlotsByDates(array $dates): SlotDtoCollection
    {
        $slots = $this->slotRepository->getFreeSlotsByDates($dates);

        return SlotDtoCollection::fromModelsCollection($slots);
    }

    public function getFreeAssetSlotsByDates(UuidInterface $assetId, array $dates): SlotDtoCollection
    {
        $slots = $this->slotRepository->getFreeAssetSlotsByDates($assetId, $dates);

        return SlotDtoCollection::fromModelsCollection($slots);
    }
}
