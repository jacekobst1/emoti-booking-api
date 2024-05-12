<?php

declare(strict_types=1);

namespace App\Modules\OldReservation\Services\Creation;

final class ReservationFactory
{
    /**
     * @param array{
     *     date_from: string,
     *     date_to: string,
     *  } $data
     */
    public function generate(array $data): Reservation
    {
        return new Reservation();
    }
}
