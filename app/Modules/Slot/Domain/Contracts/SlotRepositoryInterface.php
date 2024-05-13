<?php

declare(strict_types=1);

namespace App\Modules\Slot\Domain\Contracts;

use App\Modules\Slot\Domain\Models\Slot;
use Illuminate\Support\Collection;
use Ramsey\Uuid\UuidInterface;

interface SlotRepositoryInterface
{
    /**
     * @param non-empty-list<non-empty-string> $dates
     * @return Collection<int, Slot>
     */
    public function getFreeSlotsByDates(array $dates): Collection;

    /**
     * @param non-empty-list<non-empty-string> $dates
     * @return Collection<int, Slot>
     */
    public function getFreeAssetSlotsByDates(UuidInterface $assetId, array $dates): Collection;
}
