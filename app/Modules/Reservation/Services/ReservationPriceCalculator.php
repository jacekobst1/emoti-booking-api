<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Services;

use App\Modules\Vacant\Vacant;
use Illuminate\Support\Collection;

final class ReservationPriceCalculator
{
    /**
     * @param Collection<int, Vacant> $vacancies
     */
    public function calculatePrice(Collection $vacancies): int
    {
        return $vacancies->sum('price');
    }
}
