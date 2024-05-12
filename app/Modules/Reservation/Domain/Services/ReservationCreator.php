<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Domain\Services;

use App\Http\Exceptions\ConflictException;
use App\Modules\Reservation\Domain\Contracts\ReservationCreatorInterface;
use App\Modules\Reservation\Domain\Models\Reservation;
use App\Modules\Slot\Domain\Contracts\DataTransferObjects\SlotDtoCollection;
use App\Modules\Slot\Domain\Contracts\SlotGetterInterface;
use App\Modules\Slot\Domain\Contracts\SlotReserverInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use Throwable;

final readonly class ReservationCreator implements ReservationCreatorInterface
{
    public function __construct(
        private SlotGetterInterface $slotGetter,
        private SlotReserverInterface $slotReserver,
    ) {
    }

    /**
     * @param array{
     *     date_from: string,
     *     date_to: string,
     * } $data
     *
     * @throws Throwable|ConflictException
     */
    public function handle(array $data): Reservation
    {
        $dates = $this->getArrayOfDays($data['date_from'], $data['date_to']);
        $slots = $this->getMatchingFreeSlots($dates);

        return DB::transaction(function () use ($data, $slots) {
            $reservation = $this->createModel($data, $slots);
            $this->slotReserver->reserveSlots($reservation->id, $slots->getIds());

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

    /**
     * @param non-empty-list<non-empty-string> $dates
     *
     * @throws ConflictException
     */
    private function getMatchingFreeSlots(array $dates): SlotDtoCollection
    {
        $freeSlots = $this->slotGetter->getFreeSlotsByDates($dates);

        /**@var ?SlotDtoCollection $selectedSlots */
        $matchingFreeSlots = $freeSlots->groupByAssetId()->first(
            static fn(SlotDtoCollection $slots): bool => $slots->count() === count($dates)
        );

        if (!$matchingFreeSlots) {
            throw new ConflictException('No asset available for given dates');
        }

        return $matchingFreeSlots;
    }

    /**
     * @param array{
     *     date_from: string,
     *     date_to: string,
     * } $data
     */
    private function createModel(array $data, SlotDtoCollection $slots): Reservation
    {
        $reservation = Reservation::make([
            'date_from' => $data['date_from'],
            'date_to' => $data['date_to'],
        ]);

        $reservation->user_id = auth()->id();
        $reservation->asset_id = $slots->first()->assetId;
        $reservation->total_price = $slots->getTotalPrice();

        $reservation->save();

        return $reservation;
    }
}
