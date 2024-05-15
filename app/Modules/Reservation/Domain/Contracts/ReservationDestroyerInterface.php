<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Domain\Contracts;

use App\Modules\Reservation\Domain\Models\Reservation;

interface ReservationDestroyerInterface
{
    public function delete(Reservation $reservation): void;
}
