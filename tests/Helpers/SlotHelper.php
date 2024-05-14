<?php

declare(strict_types=1);

namespace Tests\Helpers;

use App\Modules\Slot\Domain\Contracts\DataTransferObjects\SlotDto;
use App\Modules\Slot\Domain\Contracts\DataTransferObjects\SlotDtoCollection;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Str;
use Ramsey\Uuid\UuidInterface;

final class SlotHelper
{
    public static function getSlotDtoCollection(
        ?string $dateFrom = null,
        ?string $dateTo = null,
        ?UuidInterface $assetId = null,
    ): SlotDtoCollection {
        /** @var non-empty-list<Carbon> $period */
        $period = CarbonPeriod::create(
            $dateFrom ?? '2022-01-01',
            $dateTo ?? '2022-01-01',
        )->toArray();

        $slotDtoCollection = new SlotDtoCollection();

        foreach ($period as $date) {
            $slotDtoCollection[] = new SlotDto(
                id: Str::uuid(),
                assetId: $assetId ?? Str::uuid(),
                date: $date,
                price: 1000,
            );
        }

        return $slotDtoCollection;
    }
}
