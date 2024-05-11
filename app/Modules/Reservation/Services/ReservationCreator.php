<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Services;

use App\Modules\Reservation\Requests\PostReservationsRequest;
use App\Modules\Reservation\Reservation;

final class ReservationCreator
{
    public function handle(PostReservationsRequest $data): Reservation
    {
        // TODO business logic validation

        return Reservation::create($data->toArray());
    }
}
