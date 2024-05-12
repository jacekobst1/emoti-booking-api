<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Domain\Contracts;

use App\Modules\OldReservation\Reservation;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Ramsey\Uuid\UuidInterface;

interface ReservationGetterInterface
{
    /**
     * @return LengthAwarePaginator<Reservation>
     */
    public function paginateUserReservations(UuidInterface $userId): LengthAwarePaginator;

    /**
     * @return LengthAwarePaginator<Reservation>
     */
    public function paginateAdminReservations(): LengthAwarePaginator;
}
