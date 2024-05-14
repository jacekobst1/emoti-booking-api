<?php

declare(strict_types=1);

namespace Tests\Unit\Reservation\Infrastructure;

use App\Modules\Reservation\Domain\Models\Reservation;
use App\Modules\Reservation\Infrastructure\ReservationRepository;
use Tests\Helpers\SanctumTrait;
use Tests\TestCase;

final class ReservationRepositoryTest extends TestCase
{
    use SanctumTrait;

    public function testPaginateUserReservations(): void
    {
        $this->actAsUser();

        // given
        $userId = $this->loggedUser->id;
        Reservation::factory()->count(3)->create(['user_id' => $userId]);
        Reservation::factory()->count(3)->create();
        $repository = $this->app->make(ReservationRepository::class);

        // when
        $result = $repository->paginateUserReservations($userId);

        // then
        $this->assertCount(3, $result);
    }

    public function testPaginateAdminReservations(): void
    {
        // given
        Reservation::factory()->count(3)->create();
        Reservation::factory()->count(3)->create();
        $repository = $this->app->make(ReservationRepository::class);

        // when
        $result = $repository->paginateAdminReservations();

        // then
        $this->assertCount(6, $result);
    }
}
