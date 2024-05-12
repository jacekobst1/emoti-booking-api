<?php

declare(strict_types=1);

namespace App\Modules\OldReservation;

final readonly class ReservationModelManager
{
    /**
     * @param non-empty-list<non-empty-string> $vacanciesIds
     */
    public function saveWithVacancies(Reservation $reservation, array $vacanciesIds): Reservation
    {
        $reservation->save();
        $reservation->vacancies()->attach($vacanciesIds);

        return $reservation;
    }
}
