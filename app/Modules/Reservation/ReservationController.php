<?php

declare(strict_types=1);

namespace App\Modules\Reservation;

use App\Http\Controllers\Controller;
use App\Modules\Reservation\Requests\PostReservationsRequest;
use App\Modules\Reservation\Services\ReservationCreator;
use App\Shared\Response\JsonResp;
use Illuminate\Http\JsonResponse;

final class ReservationController extends Controller
{
    public function post(
        PostReservationsRequest $request,
        ReservationCreator $reservationCreator,
    ): JsonResponse {
        $reservation = $reservationCreator->handle($request);

        return JsonResp::created($reservation->id);
    }
}
