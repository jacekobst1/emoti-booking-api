<?php

declare(strict_types=1);

namespace Tests\Unit\Reservation\Domain\Services\SlotsFinder;

use App\Modules\Reservation\Domain\Services\SlotsFinder\AssetSlotsFinder;
use App\Modules\Reservation\Domain\Services\SlotsFinder\RandomSlotsFinder;
use App\Modules\Reservation\Domain\Services\SlotsFinder\SlotsFinderFactory;
use Illuminate\Support\Str;
use Tests\TestCase;

final class SlotsFinderFactoryTest extends TestCase
{
    public function testMakeWithoutAsset(): void
    {
        // given
        $slotsFinderFactory = $this->app->make(SlotsFinderFactory::class);

        // when
        $result = $slotsFinderFactory->make(null);

        // then
        $this->assertInstanceOf(RandomSlotsFinder::class, $result);
    }

    public function testMakeWithAsset(): void
    {
        // given
        $slotsFinderFactory = $this->app->make(SlotsFinderFactory::class);

        // when
        $result = $slotsFinderFactory->make(Str::uuid());

        // then
        $this->assertInstanceOf(AssetSlotsFinder::class, $result);
    }
}
