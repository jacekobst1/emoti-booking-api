<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Domain\Contracts;

use App\Modules\Reservation\Domain\Models\Reservation;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ReservationGetterInterface
{
    /**
     * @return LengthAwarePaginator<Reservation>
     */
    public function paginateLoggedUserReservations(): LengthAwarePaginator;

    /**
     * @return LengthAwarePaginator<Reservation>
     */
    public function paginateAdminReservations(): LengthAwarePaginator;
}
