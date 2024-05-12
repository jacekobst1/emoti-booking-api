<?php

declare(strict_types=1);

namespace App\Modules\OldReservation\Services\Creation;

use App\Http\Exceptions\ConflictException;
use App\Modules\OldAsset\Asset;
use App\Modules\OldAsset\VacantRepository;
use App\Modules\OldReservation\Requests\PostReservationsRequest;
use App\Modules\OldReservation\Reservation;
use App\Modules\OldReservation\ReservationModelManager;
use App\Modules\OldReservation\Services\ReservationPriceCalculator;
use App\Modules\OldReservation\Verifiers\ReservationVerifier;
use Illuminate\Support\Collection;

final readonly class ReservationCreatorOld
{
    public function __construct(
        private VacantRepository $vacantRepository,
        private ReservationVerifier $reservationVerifier,
        private ReservationPriceCalculator $reservationPriceCalculator,
        private ReservationModelManager $reservationModelManager,
    ) {
    }

    /**
     * @throws ConflictException
     */
    public function handle(PostReservationsRequest $data): Reservation
    {
        $reservationDays = $data->getArrayOfDays();
        $vacancies = $this->vacantRepository->getByDates($reservationDays);

        $this->reservationVerifier->verifyReservationCanBeMade($vacancies, $reservationDays);

        return $this->storeReservation($data, $vacancies);
    }

    /**
     * @param Collection<int, Asset> $vacancies
     */
    private function storeReservation(PostReservationsRequest $data, Collection $vacancies): Reservation
    {
        $price = $this->reservationPriceCalculator->calculatePrice($vacancies);

        $reservation = new Reservation($data->toArray());
        $reservation->total_price = $price;
        $reservation->user_id = auth()->id();

        /** @var non-empty-list<non-empty-string> $vacanciesIds */
        $vacanciesIds = $vacancies->pluck('id')->toArray();

        return $this->reservationModelManager->saveWithVacancies(
            $reservation,
            $vacanciesIds,
        );
    }
}
