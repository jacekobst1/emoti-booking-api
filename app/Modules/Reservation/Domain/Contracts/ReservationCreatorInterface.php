<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Domain\Contracts;

use App\Http\Exceptions\ConflictException;
use App\Modules\Reservation\Domain\Models\Reservation;
use Throwable;

interface ReservationCreatorInterface
{
    /**
     * @param array{
     *     date_from: string,
     *     date_to: string,
     * } $data
     *
     * @throws Throwable|ConflictException
     */
    public function handle(array $data): Reservation;
}
