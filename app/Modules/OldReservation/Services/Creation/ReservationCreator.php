<?php

declare(strict_types=1);

namespace App\Modules\OldReservation\Services\Creation;

use App\Modules\OldReservation\Requests\PostReservationsRequest;
use App\Modules\OldReservation\Reservation;
use Illuminate\Support\Facades\DB;

final readonly class ReservationCreator
{
    public function __construct()
    {
    }

    public function handle(PostReservationsRequest $data): Reservation
    {
        $reservationTemplate = $this->reservationFactory->generate($data->toArray());

        return DB::transaction(function () use ($reservationTemplate) {
            $reservationModel = $this->storeReservation($reservationTemplate);
            $this->storeSlots($reservationModel->id, $reservationTemplate->slotsIds);

            return $reservationModel;
        });
    }

    private function storeReservation($reservationTemplate): Reservation
    {
        $reservationModel = Reservation::ofTemplate($reservationTemplate);

        return $this->modelManager->save($reservationModel);
    }

    private function reserveSlots($reservationId, $slotsIds): void
    {
        $this->slotManager->reserveSlots($slotIds, $reservationId);
    }
}
