<?php

declare(strict_types=1);

namespace App\Modules\Reservation;

use App\Http\Controllers\Controller;
use App\Modules\Reservation\Requests\PostReservationsRequest;
use App\Modules\Reservation\Resources\ReservationResource;
use App\Modules\Reservation\Services\ReservationCreator;
use App\Modules\Reservation\Services\ReservationGetter;
use App\Shared\Response\JsonResp;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class ReservationController extends Controller
{
    public function getReservationsList(ReservationRepository $reservationRepository): AnonymousResourceCollection
    {
        $reservations = $reservationRepository->paginate();

        return ReservationResource::collection($reservations);
    }

    public function postReservation(
        PostReservationsRequest $request,
        ReservationCreator $reservationCreator,
    ): JsonResponse {
        $reservation = $reservationCreator->handle($request);

        return JsonResp::created($reservation->id);
    }
}
