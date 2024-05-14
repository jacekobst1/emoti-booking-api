<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Domain\Services\SlotsFinder;

use App\Modules\Reservation\Domain\Contracts\SlotsFinderFactoryInterface;
use Illuminate\Foundation\Application;
use Ramsey\Uuid\UuidInterface;

final readonly class SlotsFinderFactory implements SlotsFinderFactoryInterface
{
    public function __construct(private Application $app)
    {
    }

    public function make(?UuidInterface $assetId): SlotsFinderInterface
    {
        return $assetId
            ? $this->app->make(AssetSlotsFinder::class, ['assetId' => $assetId])
            : $this->app->make(RandomSlotsFinder::class);
    }
}
