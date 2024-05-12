<?php

declare(strict_types=1);

namespace App\Modules\Reservation;

use App\Http\Controllers\Controller;
use App\Http\Exceptions\ConflictException;
use App\Modules\Auth\Enums\RoleEnum;
use App\Modules\Reservation\Requests\PostReservationsRequest;
use App\Modules\Reservation\Resources\ReservationResource;
use App\Modules\Reservation\Services\ReservationCreator;
use App\Modules\User\User;
use App\Shared\Response\JsonResp;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class ReservationController extends Controller
{
    public function getReservationsList(ReservationRepository $reservationRepository): AnonymousResourceCollection
    {
        /** @var User $user */
        $user = auth()->user();
        $isAdmin = $user->hasRole(RoleEnum::Admin->value);

        $reservations = $reservationRepository->sortByDatesAndPaginateByUser($isAdmin ? null : $user->id);

        return ReservationResource::collection($reservations);
    }

    /**
     * @throws ConflictException
     */
    public function postReservation(
        PostReservationsRequest $request,
        ReservationCreator $reservationCreator,
    ): JsonResponse {
        $reservation = $reservationCreator->handle($request);

        return JsonResp::created($reservation->id);
    }
}
