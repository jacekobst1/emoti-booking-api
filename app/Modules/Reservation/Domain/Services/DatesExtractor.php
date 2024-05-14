<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Domain\Services;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

final readonly class DatesExtractor
{
    /**
     * @return non-empty-list<non-empty-string>
     *
     * We're removing last date because that day shouldn't be counted as a day of reservation.
     * Example:
     * - we have reservation from 2022-01-01 to 2022-01-03
     * - reservation is theoretically for 3 days, but in reality we want to count only 2022-01-01 and 2022-01-02
     *   cause 2022-01-03 can be used in another reservation
     */
    public function extractDates(string $dateFrom, string $dateTo): array
    {
        /** @var non-empty-list<Carbon> $period */
        $period = CarbonPeriod::create($dateFrom, $dateTo)->toArray();

        array_pop($period);

        /** @var non-empty-list<non-empty-string> */
        return array_map(
            static fn(Carbon $date): string => $date->toDateString(),
            $period
        );
    }
}
