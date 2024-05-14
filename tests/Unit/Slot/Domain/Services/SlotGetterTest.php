<?php

declare(strict_types=1);

namespace Tests\Unit\Slot\Domain\Services;

use App\Modules\Slot\Domain\Contracts\DataTransferObjects\SlotDtoCollection;
use App\Modules\Slot\Domain\Contracts\SlotRepositoryInterface;
use App\Modules\Slot\Domain\Services\SlotGetter;
use Illuminate\Support\Str;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

final class SlotGetterTest extends TestCase
{
    public function testGetFreeSlotsByDates(): void
    {
        $dates = ['2022-01-01', '2022-01-02'];
        $slotDtoCollection = new SlotDtoCollection([]);

        // mock
        $this->instance(
            SlotRepositoryInterface::class,
            Mockery::mock(
                SlotRepositoryInterface::class,
                function (MockInterface $mock) use ($dates, $slotDtoCollection) {
                    $mock->shouldReceive('getFreeSlotsByDates')
                        ->once()
                        ->with($dates)
                        ->andReturn($slotDtoCollection);
                }
            )
        );

        // given
        $slotGetter = $this->app->make(SlotGetter::class);

        // when
        $result = $slotGetter->getFreeSlotsByDates($dates);

        // then
        $this->assertTrue(
            $slotDtoCollection->equals($result)
        );
    }

    public function testGetFreeAssetSlotsByDates(): void
    {
        $assetId = Str::uuid();
        $dates = ['2022-01-01', '2022-01-02'];
        $slotDtoCollection = new SlotDtoCollection([]);

        // mock
        $this->instance(
            SlotRepositoryInterface::class,
            Mockery::mock(
                SlotRepositoryInterface::class,
                function (MockInterface $mock) use ($assetId, $dates, $slotDtoCollection) {
                    $mock->shouldReceive('getFreeAssetSlotsByDates')
                        ->once()
                        ->with($assetId, $dates)
                        ->andReturn($slotDtoCollection);
                }
            )
        );

        // given
        $slotGetter = $this->app->make(SlotGetter::class);

        // when
        $result = $slotGetter->getFreeAssetSlotsByDates($assetId, $dates);

        // then
        $this->assertTrue(
            $slotDtoCollection->equals($result)
        );
    }
}
