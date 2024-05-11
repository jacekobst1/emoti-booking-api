<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Verifiers;

use App\Http\Exceptions\ConflictException;
use App\Modules\Vacant\Vacant;
use Illuminate\Support\Collection;

final class ReservationVerifier
{
    /**
     * @param Collection<int, Vacant> $vacancies
     * @param list<non-empty-string> $reservationDays
     *
     * @throws ConflictException
     */
    public function verifyReservationCanBeMade(Collection $vacancies, array $reservationDays): void
    {
        $this->verifyVacanciesSetForAllDates($vacancies, $reservationDays);
        $this->verifyBedsAvailability($vacancies);
    }

    /**
     * @param Collection<int, Vacant> $vacancies
     * @param list<non-empty-string> $reservationDays
     *
     * @throws ConflictException
     */
    private function verifyVacanciesSetForAllDates(Collection $vacancies, array $reservationDays): void
    {
        if ($vacancies->count() !== count($reservationDays)) {
            throw new ConflictException('Not on all dates the facility works');
        }
    }

    /**
     * @param Collection<int, Vacant> $vacancies
     *
     * @throws ConflictException
     */
    private function verifyBedsAvailability(Collection $vacancies): void
    {
        foreach ($vacancies as $vacant) {
            if (!$vacant->bedsAreAvailable()) {
                throw new ConflictException('No beds available on some dates');
            }
        }
    }
}
