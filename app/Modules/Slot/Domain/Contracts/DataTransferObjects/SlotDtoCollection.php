<?php

declare(strict_types=1);

namespace App\Modules\Slot\Domain\Contracts\DataTransferObjects;

use App\Modules\Slot\Domain\Models\Slot;
use Illuminate\Support\Collection;
use Ramsey\Uuid\UuidInterface;

/**
 * @extends Collection<int, SlotDto>
 */
final class SlotDtoCollection extends Collection
{
    /**
     * @param Collection<int, Slot> $models
     */
    public static function fromModelsCollection(Collection $models): self
    {
        $collection = new self();

        foreach ($models as $model) {
            $collection->push(SlotDto::fromModel($model));
        }

        return $collection;
    }

    public function getTotalPrice(): int
    {
        return $this->sum(
            static fn(SlotDto $slot): int => $slot->price
        );
    }

    /**
     * @return list<UuidInterface>
     */
    public function getIds(): array
    {
        return $this->map(
            static fn(SlotDto $slot): UuidInterface => $slot->id
        )->toArray();
    }

    /**
     * @return self<string, self<int, SlotDto>>
     */
    public function groupByAssetId(): self
    {
        return $this->groupBy(
            static fn(SlotDto $slot): UuidInterface => $slot->assetId
        );
    }
}
