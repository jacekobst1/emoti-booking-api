<?php

declare(strict_types=1);

namespace App\Modules\Slot\Infrastructure;

use App\Modules\Slot\Domain\Contracts\SlotRepositoryInterface;
use App\Modules\Slot\Domain\Models\Slot;
use Illuminate\Support\Collection;

final readonly class SlotRepository implements SlotRepositoryInterface
{
    public function __construct(private Slot $model)
    {
    }

    /**
     * @param non-empty-list<non-empty-string> $dates
     * @return Collection<int, Slot>
     */
    public function getFreeSlotsByDates(array $dates): Collection
    {
        return $this->model
            ->select('id', 'asset_id', 'date', 'price')
            ->whereIn('date', $dates)
            ->whereNull('reservation_id')
            ->get();
    }
}
