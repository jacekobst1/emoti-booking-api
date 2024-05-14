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
use App\Modules\Slot\Domain\Contracts\SlotReserverInterface;
use Illuminate\Support\Carbon;
use Mockery;
use Mockery\MockInterface;
use Tests\Helpers\SanctumTrait;
use Tests\Helpers\SlotHelper;
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
    public function testHandleSuccess(): void
    {
        // mock
        $slotDtoCollection = SlotHelper::getSlotDtoCollection();
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
            date_from: Carbon::now()->addDay()->toDateString(),
            date_to: Carbon::now()->addDays(2)->toDateString(),
            asset_id: null,
        ))->toArray();
        $creator = $this->app->make(ReservationCreator::class);

        // when
        $result = $creator->handle($data);

        // then
        $this->assertSame($reservation, $result);
    }

    /**
     * @throws Throwable
     * @throws ConflictException
     */
    public function testHandleAndSlotsNotFound(): void
    {
        // then
        $this->expectException(ConflictException::class);

        // mock
        $randomSlotsFinder = Mockery::mock(
            SlotsFinderInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('findByDates')
                    ->once()
                    ->andReturnNull();
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
                $mock->shouldNotHaveBeenCalled();
            })
        );

        $this->instance(
            SlotReserverInterface::class,
            Mockery::mock(
                SlotReserverInterface::class,
                function (MockInterface $mock) use ($reservation) {
                    $mock->shouldNotHaveBeenCalled();
                }
            )
        );

        // given
        $data = (new PostReservationRequest(
            date_from: Carbon::now()->addDay()->toDateString(),
            date_to: Carbon::now()->addDays(2)->toDateString(),
            asset_id: null,
        ))->toArray();
        $creator = $this->app->make(ReservationCreator::class);

        // when
        $result = $creator->handle($data);

        // then
        $this->assertSame($reservation, $result);
    }
}
