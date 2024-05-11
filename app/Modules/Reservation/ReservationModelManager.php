<?php

declare(strict_types=1);

namespace App\Modules\Reservation;

final readonly class ReservationModelManager
{
    public function __construct(
        private Reservation $model
    ) {
    }

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
