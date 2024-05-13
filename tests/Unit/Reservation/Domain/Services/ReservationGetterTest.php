<?php

declare(strict_types=1);

namespace Tests\Unit\Reservation\Domain\Services;

use App\Modules\Auth\Domain\Contracts\AuthServiceInterface;
use App\Modules\Reservation\Domain\Contracts\ReservationRepositoryInterface;
use App\Modules\Reservation\Domain\Services\ReservationGetter;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

final class ReservationGetterTest extends TestCase
{
    public function testPaginateLoggedUserReservations(): void
    {
        // mock
        $this->instance(
            ReservationRepositoryInterface::class,
            Mockery::mock(ReservationRepositoryInterface::class, function (MockInterface $mock) {
                $mock->shouldReceive('paginateUserReservations')
                    ->once()
                    ->andReturn(
                        new LengthAwarePaginator([], 123, 18, 3)
                    );
            })
        );

        $this->instance(
            AuthServiceInterface::class,
            Mockery::mock(AuthServiceInterface::class, function (MockInterface $mock) {
                $mock->shouldReceive('getLoggedUserId')
                    ->once()
                    ->andReturn(Str::uuid());
            })
        );

        // given
        $reservationGetter = $this->app->make(ReservationGetter::class);

        // when
        $result = $reservationGetter->paginateLoggedUserReservations();

        // then
        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
        $this->assertSame(123, $result->total());
        $this->assertSame(18, $result->perPage());
        $this->assertSame(3, $result->currentPage());
    }

    public function testPaginateAdminReservations(): void
    {
        // mock
        $this->instance(
            ReservationRepositoryInterface::class,
            Mockery::mock(ReservationRepositoryInterface::class, function (MockInterface $mock) {
                $mock->shouldReceive('paginateAdminReservations')
                    ->once()
                    ->andReturn(
                        new LengthAwarePaginator([], 123, 18, 3)
                    );
            })
        );

        // given
        $reservationGetter = $this->app->make(ReservationGetter::class);

        // when
        $result = $reservationGetter->paginateAdminReservations();

        // then
        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
        $this->assertSame(123, $result->total());
        $this->assertSame(18, $result->perPage());
        $this->assertSame(3, $result->currentPage());
    }
}
