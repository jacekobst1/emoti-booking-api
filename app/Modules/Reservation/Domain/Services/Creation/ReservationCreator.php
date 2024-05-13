<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Domain\Services\Creation;

use App\Http\Exceptions\ConflictException;
use App\Modules\Auth\Domain\Models\User;
use App\Modules\Reservation\Domain\Contracts\ReservationCreatorInterface;
use App\Modules\Reservation\Domain\Contracts\ReservationModelManagerInterface;
use App\Modules\Reservation\Domain\DataTransferObjects\ReservationDatesDto;
use App\Modules\Reservation\Domain\Models\Reservation;
use App\Modules\Reservation\Domain\Services\SlotsFinder\SlotsFinderFactory;
use App\Modules\Slot\Domain\Contracts\DataTransferObjects\SlotDtoCollection;
use App\Modules\Slot\Domain\Contracts\SlotReserverInterface;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\UuidInterface;
use Throwable;

final readonly class ReservationCreator implements ReservationCreatorInterface
{
    public function __construct(
        private SlotsFinderFactory $slotFinderFactory,
        private ReservationModelManagerInterface $reservationModelManager,
        private SlotReserverInterface $slotReserver,
    ) {
    }

    /**
     * @param array{
     *     date_from: non-empty-string,
     *     date_to: non-empty-string,
     *     asset_id: ?UuidInterface,
     * } $data
     *
     * @throws Throwable|ConflictException
     */
    public function handle(array $data): Reservation
    {
        $dates = (new ReservationDatesDto($data['date_from'], $data['date_to']))->getArrayOfDays();
        $slots = $this->getMatchingFreeSlots($dates, $data['asset_id']);

        return DB::transaction(function () use ($data, $slots) {
            $reservation = $this->createModel($data, $slots);
            $this->slotReserver->reserveSlots($reservation->id, $slots->getIds());

            return $reservation;
        });
    }

    /**
     * @param non-empty-list<non-empty-string> $dates
     *
     * @throws ConflictException
     */
    private function getMatchingFreeSlots(array $dates, ?UuidInterface $assetId = null): SlotDtoCollection
    {
        $slotsFinder = $this->slotFinderFactory->make($assetId);
        $matchingFreeSlots = $slotsFinder->findByDates($dates);

        if (!$matchingFreeSlots) {
            throw new ConflictException('No asset available for given dates');
        }

        return $matchingFreeSlots;
    }

    /**
     * @param array{
     *     date_from: non-empty-string,
     *     date_to: non-empty-string,
     * } $data
     */
    private function createModel(array $data, SlotDtoCollection $slots): Reservation
    {
        $reservation = new Reservation([
            'date_from' => $data['date_from'],
            'date_to' => $data['date_to'],
        ]);

        // just for the purpose of making frontend work without authentication
        $reservation->user_id = auth()->id() ?? User::whereEmail('user@gmail.com')->first()->id;
        $reservation->asset_id = $slots->first()->assetId;
        $reservation->total_price = $slots->getTotalPrice();

        $this->reservationModelManager->save($reservation);

        return $reservation;
    }
}