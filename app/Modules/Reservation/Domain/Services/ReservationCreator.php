<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Domain\Services;

use App\Modules\Reservation\Domain\Contracts\ReservationCreatorInterface;
use App\Modules\Reservation\Domain\Models\Reservation;
use App\Modules\Slot\Domain\Contracts\DataTransferObjects\SlotDtoCollection;
use App\Modules\Slot\Domain\Contracts\SlotGetterInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Throwable;

final readonly class ReservationCreator implements ReservationCreatorInterface
{
    public function __construct(
        private SlotGetterInterface $slotGetter,
    ) {
    }

    /**
     * @param array{
     *     date_from: string,
     *     date_to: string,
     * } $data
     *
     * @throws Throwable
     */
    public function handle(array $data): Reservation
    {
        $dates = $this->getArrayOfDays($data['date_from'], $data['date_to']);

        /** @var Collection<string, SlotDtoCollection> $groupedSlots */
        $groupedSlots = $this->slotGetter->getSlotsByDates($dates)->groupByAssetId();

        /**@var ?SlotDtoCollection $selectedSlots */
        $selectedSlots = null;

        foreach ($groupedSlots as $assetId => $slots) {
            if ($slots->count() === count($dates)) {
                $selectedSlots = $slots;
                break;
            }
        }

        if (!$selectedSlots) {
            throw new Exception('No asset available for given dates');
        }

        return DB::transaction(function () use ($selectedSlots, $data) {
            $reservation = Reservation::make([
                'date_from' => $data['date_from'],
                'date_to' => $data['date_to'],
            ]);
            $reservation->user_id = auth()->id();
            $reservation->asset_id = $selectedSlots->first()->assetId;
            $reservation->total_price = $selectedSlots->getTotalPrice();
            $reservation->save();

            // $this->reserveSlots($reservation->id, $selectedSlots->getIds());
//        foreach ($selectedSlots as $slot) {
//            $slot->reservation()->associate($reservation->id);
//        }

            return $reservation;
        });
    }

    /**
     * @return non-empty-list<non-empty-string>
     *
     * We're removing last date because that day shouldn't be counted as a day of reservation.
     * Example:
     * - we have reservation from 2022-01-01 to 2022-01-03
     * - reservation is theoretically for 3 days, but in reality we want to count only 2022-01-01 and 2022-01-02
     *   cause 2022-01-03 can be used in another reservation
     */
    private function getArrayOfDays(string $dateFrom, string $dateTo): array // TODO przenieś gdzieś indziej
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
