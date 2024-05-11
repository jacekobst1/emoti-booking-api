<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Requests;

use Carbon\CarbonPeriod;
use Spatie\LaravelData\Attributes\Validation\After;
use Spatie\LaravelData\Attributes\Validation\Date;
use Spatie\LaravelData\Data;

final class PostReservationsRequest extends Data
{
    public function __construct(
        #[Date]
        public string $date_from,

        #[Date, After('date_from')]
        public string $date_to,
    ) {
    }

    /**
     * @return list<non-empty-string>
     *
     * We're removing last date because that day shouldn't be counted as a day of reservation.
     * Example:
     * - we have reservation from 2022-01-01 to 2022-01-03
     * - reservation is theoretically for 3 days, but in reality we want to count only 2022-01-01 and 2022-01-02
     *   cause 2022-01-03 can be used in another reservation
     *
     */
    public function getArrayOfDays(): array
    {
        $period = CarbonPeriod::create($this->date_from, $this->date_to)->toArray();

        array_pop($period);

        return array_map(
            static fn($date): string => $date->toDateString(),
            $period
        );
    }
}
