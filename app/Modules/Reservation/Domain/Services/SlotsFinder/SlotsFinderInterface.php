<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Domain\Services\SlotsFinder;

use App\Modules\Slot\Domain\Contracts\DataTransferObjects\SlotDtoCollection;

interface SlotsFinderInterface
{
    /**
     * @param non-empty-list<non-empty-string> $dates
     */
    public function findByDates(array $dates): ?SlotDtoCollection;
}
