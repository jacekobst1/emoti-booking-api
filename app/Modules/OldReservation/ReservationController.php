<?php

declare(strict_types=1);

namespace App\Modules\OldReservation;

use App\Http\Controllers\Controller;
use App\Http\Exceptions\ConflictException;
use App\Modules\OldReservation\Requests\PostReservationsRequest;
use App\Modules\OldReservation\Resources\AdminReservationResource;
use App\Modules\OldReservation\Resources\ReservationResource;
use App\Modules\OldReservation\Services\Creation\ReservationCreatorOld;
use App\Modules\User\User;
use App\Shared\Response\JsonResp;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class ReservationController extends Controller
{
    public function getAdminReservationsList(ReservationRepository $reservationRepository): AnonymousResourceCollection
    {
        $reservations = $reservationRepository->paginateAdminReservations();

        return AdminReservationResource::collection($reservations);
    }

    public function getUserReservationsList(ReservationRepository $reservationRepository): AnonymousResourceCollection
    {
        /** @var User $user */
        $user = auth()->user();

        $reservations = $reservationRepository->paginateUserReservations($user->id);

        return ReservationResource::collection($reservations);
    }

    /**
     * @throws ConflictException
     */
    public function postReservation(
        PostReservationsRequest $request,
        ReservationCreatorOld $reservationCreator,
    ): JsonResponse {
        $reservation = $reservationCreator->handle($request);

        return JsonResp::created($reservation->id);
    }
}
