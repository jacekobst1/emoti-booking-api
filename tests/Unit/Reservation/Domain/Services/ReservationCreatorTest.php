<?php

declare(strict_types=1);

namespace Tests\Unit\Reservation\Domain\Services;

use App\Http\Exceptions\ConflictException;
use App\Modules\Reservation\Application\Http\Requests\PostReservationRequest;
use App\Modules\Reservation\Domain\Contracts\ReservationModelManagerInterface;
use App\Modules\Reservation\Domain\Contracts\SlotsFinderFactoryInterface;
use App\Modules\Reservation\Domain\Models\Reservation;
use App\Modules\Reservation\Domain\Services\ReservationCreator;
use App\Modules\Reservation\Domain\Services\SlotsFinder\SlotsFinderInterface;
use App\Modules\Slot\Domain\Contracts\DataTransferObjects\SlotDto;
use App\Modules\Slot\Domain\Contracts\DataTransferObjects\SlotDtoCollection;
use App\Modules\Slot\Domain\Contracts\SlotReserverInterface;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Mockery;
use Mockery\MockInterface;
use Tests\Helpers\SanctumTrait;
use Tests\TestCase;
use Throwable;

final class ReservationCreatorTest extends TestCase
{
    use SanctumTrait;

    protected function setUp(): void
    {
        parent::setUp();

        self::actAsUser();
    }

    /**
     * @throws Throwable
     * @throws ConflictException
     */
    public function testHandle(): void
    {
        // mock
        $slotDtoCollection = new SlotDtoCollection([ // TODO create helper class
            new SlotDto(
                id: Str::uuid(),
                assetId: Str::uuid(),
                date: Carbon::parse('2022-01-01'),
                price: 1000,
            ),
            new SlotDto(
                id: Str::uuid(),
                assetId: Str::uuid(),
                date: Carbon::parse('2022-01-02'),
                price: 1300,
            ),
        ]);
        $randomSlotsFinder = Mockery::mock(
            SlotsFinderInterface::class,
            function (MockInterface $mock) use ($slotDtoCollection) {
                $mock->shouldReceive('findByDates')
                    ->once()
                    ->andReturn($slotDtoCollection);
            }
        );

        $this->instance(
            SlotsFinderFactoryInterface::class,
            Mockery::mock(SlotsFinderFactoryInterface::class, function (MockInterface $mock) use ($randomSlotsFinder) {
                $mock->shouldReceive('make')
                    ->with(null)
                    ->once()
                    ->andReturn($randomSlotsFinder);
            })
        );

        $reservation = Reservation::factory()->create();
        $this->instance(
            ReservationModelManagerInterface::class,
            Mockery::mock(ReservationModelManagerInterface::class, function (MockInterface $mock) use ($reservation) {
                $mock->shouldReceive('newInstance')
                    ->once()
                    ->andReturn($reservation);
                $mock->shouldReceive('save')
                    ->once()
                    ->andReturnNull();
            })
        );

        $this->instance(
            SlotReserverInterface::class,
            Mockery::mock(
                SlotReserverInterface::class,
                function (MockInterface $mock) use ($reservation, $slotDtoCollection) {
                    $mock->shouldReceive('reserveSlots')
                        ->once()
                        ->with($reservation->id, $slotDtoCollection->getIds())
                        ->andReturnNull();
                }
            )
        );

        // given
        $data = (new PostReservationRequest(
            date_from: '2022-01-01',
            date_to: '2022-01-03',
            asset_id: null,
        ))->toArray();
        $creator = $this->app->make(ReservationCreator::class);

        // when
        $result = $creator->handle($data);

        // then
        $this->assertSame($reservation, $result);
    }
}
