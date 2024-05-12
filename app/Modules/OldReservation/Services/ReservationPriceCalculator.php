<?php

declare(strict_types=1);

namespace App\Modules\OldReservation\Services;

use App\Modules\OldAsset\Asset;
use Illuminate\Support\Collection;

final class ReservationPriceCalculator
{
    /**
     * @param Collection<int, Asset> $vacancies
     */
    public function calculatePrice(Collection $vacancies): int
    {
        return $vacancies->sum('price');
    }
}
