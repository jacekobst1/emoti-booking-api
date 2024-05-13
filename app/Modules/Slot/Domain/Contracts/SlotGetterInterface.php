<?php

declare(strict_types=1);

namespace App\Modules\Slot\Domain\Contracts;

use App\Modules\Slot\Domain\Contracts\DataTransferObjects\SlotDtoCollection;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

interface SlotGetterInterface
{
    /**
     * @param list<Carbon> $dates
     */
    public function getFreeSlotsByDates(array $dates): SlotDtoCollection;

    /**
     * @param list<Carbon> $dates
     */
    public function getFreeAssetSlotsByDates(UuidInterface $assetId, array $dates): SlotDtoCollection;
}
