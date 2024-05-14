<?php

declare(strict_types=1);

namespace Tests\Unit\Slot\Infrastructure;

use App\Modules\Asset\Domain\Models\Asset;
use App\Modules\Slot\Domain\Models\Slot;
use App\Modules\Slot\Infrastructure\SlotRepository;
use Tests\TestCase;

final class SlotRepositoryTest extends TestCase
{
    public function testGetFreeSlotsByDates(): void
    {
        // given
        $asset = Asset::factory()->create();
        $slot1 = Slot::factory()->for($asset)->create(['date' => '2022-01-01']);
        $slot2 = Slot::factory()->for($asset)->create(['date' => '2022-01-02']);
        $slotRepository = $this->app->make(SlotRepository::class);

        // when
        $result = $slotRepository->getFreeSlotsByDates(['2022-01-01', '2022-01-02']);

        // then
        $this->assertCount(2, $result);
        $this->assertEquals($slot1->id, $result[0]->id);
        $this->assertEquals($slot2->id, $result[1]->id);
    }

    public function testGetFreeAssetSlotsByDates(): void
    {
        // given
        $asset = Asset::factory()->create();
        $slot1 = Slot::factory()->for($asset)->create(['date' => '2022-01-01']);
        $slotFromAnotherAsset = Slot::factory()->create(['date' => '2022-01-02']);
        $slot2 = Slot::factory()->for($asset)->create(['date' => '2022-01-02']);
        $slotRepository = $this->app->make(SlotRepository::class);

        // when
        $result = $slotRepository->getFreeAssetSlotsByDates($asset->id, ['2022-01-01', '2022-01-02']);

        // then
        $this->assertCount(2, $result);
        $this->assertEquals($slot1->id, $result[0]->id);
        $this->assertEquals($slot2->id, $result[1]->id);
    }
}
