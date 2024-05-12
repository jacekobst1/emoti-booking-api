<?php

declare(strict_types=1);

namespace App\Modules\Slot\Domain\Contracts;

use App\Modules\Slot\Domain\Models\Slot;
use Illuminate\Support\Collection;

interface SlotRepositoryInterface
{
    /**
     * @param non-empty-list<non-empty-string> $dates
     * @return Collection<int, Slot>
     */
    public function getSlotsByDates(array $dates): Collection;
}
