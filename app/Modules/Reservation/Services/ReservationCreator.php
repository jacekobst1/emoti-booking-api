<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Services;

use App\Http\Exceptions\ConflictException;
use App\Modules\Reservation\Requests\PostReservationsRequest;
use App\Modules\Reservation\Reservation;
use App\Modules\Reservation\Verifiers\ReservationVerifier;
use App\Modules\Vacant\Vacant;
use App\Modules\Vacant\VacantRepository;
use Illuminate\Support\Collection;

final readonly class ReservationCreator
{
    public function __construct(
        private VacantRepository $vacantRepository,
        private ReservationVerifier $verifier
    ) {
    }

    /**
     * @throws ConflictException
     */
    public function handle(PostReservationsRequest $data): Reservation
    {
        $reservationDays = $data->getArrayOfDays();
        $vacancies = $this->vacantRepository->getByDates($reservationDays);

        $this->verifier->verifyReservationCanBeMade($vacancies, $reservationDays);

        return $this->storeReservation($data, $vacancies);
    }

    /**
     * @param Collection<int, Vacant> $vacancies
     */
    private function storeReservation(PostReservationsRequest $data, Collection $vacancies): Reservation
    {
        $reservation = Reservation::create($data->toArray());
        $reservation->vacancies()->attach($vacancies->pluck('id')->toArray());

        return $reservation;
    }
}
