<?php

declare(strict_types=1);

namespace App\Modules\Slot\Domain\Contracts\DataTransferObjects;

use App\Modules\Slot\Domain\Contracts\SlotGetterInterface;
use App\Modules\Slot\Domain\Contracts\SlotRepositoryInterface;

final readonly class SlotGetter implements SlotGetterInterface
{
    public function __construct(private SlotRepositoryInterface $slotRepository)
    {
    }

    public function getSlotsByDates(array $dates): SlotDtoCollection
    {
        $slots = $this->slotRepository->getSlotsByDates($dates);

        return SlotDtoCollection::fromModelsCollection($slots);
    }
}
