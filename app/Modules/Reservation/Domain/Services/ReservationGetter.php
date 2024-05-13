<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Domain\Services;

use App\Modules\Reservation\Domain\Contracts\ReservationGetterInterface;
use App\Modules\Reservation\Domain\Contracts\ReservationRepositoryInterface;
use App\Modules\Reservation\Domain\Models\Reservation;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Ramsey\Uuid\UuidInterface;

final readonly class ReservationGetter implements ReservationGetterInterface
{
    public function __construct(private ReservationRepositoryInterface $repository)
    {
    }

    /**
     * @return LengthAwarePaginator<Reservation>
     */
    public function paginateUserReservations(UuidInterface $userId): LengthAwarePaginator
    {
        return $this->repository->paginateUserReservations($userId);
    }

    /**
     * @return LengthAwarePaginator<Reservation>
     */
    public function paginateAdminReservations(): LengthAwarePaginator
    {
        return $this->repository->paginateAdminReservations();
    }
}
