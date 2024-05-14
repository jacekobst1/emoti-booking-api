<?php

declare(strict_types=1);

namespace App\Modules\Slot\Domain\Contracts;

use App\Modules\Slot\Domain\Contracts\DataTransferObjects\SlotDtoCollection;
use Ramsey\Uuid\UuidInterface;

interface SlotGetterInterface
{
    /**
     * @param non-empty-list<non-empty-string> $dates
     */
    public function getFreeSlotsByDates(array $dates): SlotDtoCollection;

    /**
     * @param non-empty-list<non-empty-string> $dates
     */
    public function getFreeAssetSlotsByDates(UuidInterface $assetId, array $dates): SlotDtoCollection;
}
