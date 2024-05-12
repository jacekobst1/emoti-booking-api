<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Application\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Exceptions\ConflictException;
use App\Modules\Reservation\Application\Http\Requests\PostReservationRequest;
use App\Modules\Reservation\Domain\Contracts\ReservationCreatorInterface;
use App\Shared\Response\JsonResp;
use Illuminate\Http\JsonResponse;

final class ReservationController extends Controller
{
//    public function getAdminReservationsList(ReservationRepository $reservationRepository): AnonymousResourceCollection
//    {
//        $reservations = $reservationRepository->paginateAdminReservations();
//
//        return AdminReservationResource::collection($reservations);
//    }
//
//    public function getUserReservationsList(ReservationRepository $reservationRepository): AnonymousResourceCollection
//    {
//        /** @var User $user */
//        $user = auth()->user();
//
//        $reservations = $reservationRepository->paginateUserReservations($user->id);
//
//        return ReservationResource::collection($reservations);
//    }

    /**
     * @throws ConflictException
     */
    public function postReservation(
        PostReservationRequest $request,
        ReservationCreatorInterface $reservationCreator,
    ): JsonResponse {
        $reservation = $reservationCreator->handle($request->toArray());

        return JsonResp::created($reservation->id);
    }
}
