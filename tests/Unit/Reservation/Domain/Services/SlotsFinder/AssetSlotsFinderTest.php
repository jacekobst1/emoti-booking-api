<?php

declare(strict_types=1);

namespace Tests\Unit\Reservation\Domain\Services\SlotsFinder;

use App\Modules\Reservation\Domain\Services\SlotsFinder\AssetSlotsFinder;
use App\Modules\Slot\Domain\Contracts\DataTransferObjects\SlotDtoCollection;
use App\Modules\Slot\Domain\Contracts\SlotGetterInterface;
use Illuminate\Support\Str;
use Mockery;
use Mockery\MockInterface;
use Tests\Helpers\SlotHelper;
use Tests\TestCase;

final class AssetSlotsFinderTest extends TestCase
{
    public function testFindByDatesAndReturnNull(): void
    {
        $assetId = Str::uuid();
        $dates = ['2022-01-01', '2022-01-02'];

        // mock
        $this->instance(
            SlotGetterInterface::class,
            Mockery::mock(SlotGetterInterface::class, function (MockInterface $mock) use ($assetId, $dates) {
                $mock->shouldReceive('getFreeAssetSlotsByDates')
                    ->once()
                    ->with($assetId, $dates)
                    ->andReturn(new SlotDtoCollection([]));
            })
        );

        // given
        $assetSlotsFinder = $this->app->make(AssetSlotsFinder::class, ['assetId' => $assetId]);

        // when
        $result = $assetSlotsFinder->findByDates($dates);

        // then
        $this->assertNull($result);
    }

    public function testFindByDatesAndReturnDtoCollection(): void
    {
        $assetId = Str::uuid();
        $dates = ['2022-01-01', '2022-01-02'];
        $slotDtoCollection = SlotHelper::getSlotDtoCollection(
            dateFrom: $dates[0],
            dateTo: $dates[1],
            assetId: $assetId
        );

        // mock
        $this->instance(
            SlotGetterInterface::class,
            Mockery::mock(
                SlotGetterInterface::class,
                function (MockInterface $mock) use ($assetId, $dates, $slotDtoCollection) {
                    $mock->shouldReceive('getFreeAssetSlotsByDates')
                        ->once()
                        ->with($assetId, $dates)
                        ->andReturn($slotDtoCollection);
                }
            )
        );

        // given
        $assetSlotsFinder = $this->app->make(AssetSlotsFinder::class, ['assetId' => $assetId]);

        // when
        $result = $assetSlotsFinder->findByDates($dates);

        // then
        $this->assertSame($slotDtoCollection, $result);
    }
}
