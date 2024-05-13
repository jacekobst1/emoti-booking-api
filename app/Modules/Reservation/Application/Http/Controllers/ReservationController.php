<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Application\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Exceptions\ConflictException;
use App\Modules\Reservation\Application\Http\Requests\PostReservationRequest;
use App\Modules\Reservation\Application\Http\Resources\AdminReservationResource;
use App\Modules\Reservation\Application\Http\Resources\ReservationResource;
use App\Modules\Reservation\Domain\Contracts\ReservationCreatorInterface;
use App\Modules\Reservation\Domain\Contracts\ReservationGetterInterface;
use App\Shared\Response\JsonResp;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Throwable;

final class ReservationController extends Controller
{
    public function getAdminReservationsList(ReservationGetterInterface $getter): AnonymousResourceCollection
    {
        $reservations = $getter->paginateAdminReservations();

        return AdminReservationResource::collection($reservations);
    }

    public function getUserReservationsList(ReservationGetterInterface $getter): AnonymousResourceCollection
    {
        $reservations = $getter->paginateLoggedUserReservations();

        return ReservationResource::collection($reservations);
    }

    /**
     * @throws Throwable|ConflictException
     */
    public function postReservation(
        PostReservationRequest $request,
        ReservationCreatorInterface $reservationCreator,
    ): JsonResponse {
        $reservation = $reservationCreator->handle($request->toArray());

        return JsonResp::created($reservation->id);
    }
}
