<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Domain\Contracts;

use App\Modules\Reservation\Domain\Models\Reservation;

interface ReservationCreatorInterface
{
    /**
     * @param array{
     *     date_from: string,
     *     date_to: string,
     * } $data
     */
    public function handle(array $data): Reservation;
}
