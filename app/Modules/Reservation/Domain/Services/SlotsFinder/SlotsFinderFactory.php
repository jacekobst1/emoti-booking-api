<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Domain\Services\SlotsFinder;

use Illuminate\Foundation\Application;
use Ramsey\Uuid\UuidInterface;

final readonly class SlotsFinderFactory
{
    public function __construct(private Application $app)
    {
    }

    public function make(?UuidInterface $assetId = null): SlotsFinderInterface
    {
        return $assetId
            ? $this->app->make(AssetSlotsFinder::class, ['assetId' => $assetId])
            : $this->app->make(RandomSlotsFinder::class);
    }
}
