<?php

declare(strict_types=1);

namespace App\Modules\Slot\Domain\Contracts\DataTransferObjects;

use App\Modules\Slot\Domain\Models\Slot;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

final readonly class SlotDto
{
    public function __construct(
        public UuidInterface $id,
        public UuidInterface $assetId,
        public Carbon $date,
        public int $price,
    ) {
    }

    public static function fromModel(Slot $slot): self
    {
        return new self(
            id: $slot->id,
            assetId: $slot->asset_id,
            date: $slot->date,
            price: $slot->price,
        );
    }
}
