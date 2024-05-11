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
     * @param array<non-empty-string, mixed> $data
     * @param non-empty-list<non-empty-string> $vacanciesIds
     */
    public function createWithVacancies(array $data, array $vacanciesIds): Reservation
    {
        $reservation = $this->model->create($data);
        $reservation->vacancies()->attach($vacanciesIds);

        return $reservation;
    }
}
