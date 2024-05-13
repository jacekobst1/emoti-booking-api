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
use OpenApi\Annotations as OA;
use Throwable;

final class ReservationController extends Controller
{
    /**
     * @OA\Get (
     *     path="/api/admin/reservations",
     *     summary="Return list of all reservations",
     *     description="Return list of all reservations",
     *     operationId="get-admin-reservations",
     *     tags={"reservations"},
     *     @OA\Response(
     *         response=200,
     *         description="List of reservations",
     *         @OA\JsonContent(
     *             required={"data", "links", "meta"},
     *             @OA\Property(property="data", type="object", ref="#/components/schemas/AdminReservationResource"),
     *             @OA\Property(property="links", type="object", ref="#/components/schemas/links"),
     *             @OA\Property(property="meta", type="object", ref="#/components/schemas/meta")
     *         )
     *     ),
     *     @OA\Response(
     *        response="401",
     *        ref="#/components/responses/unauthenticated"
     *     ),
     *     @OA\Response(
     *        response="403",
     *        ref="#/components/responses/unauthorized"
     *     ),
     *     @OA\Response(
     *        response="500",
     *        ref="#/components/responses/error"
     *     )
     * )
     */
    public function getAdminReservationsList(ReservationGetterInterface $getter): AnonymousResourceCollection
    {
        $reservations = $getter->paginateAdminReservations();

        return AdminReservationResource::collection($reservations);
    }

    /**
     * @OA\Get (
     *     path="/api/reservations",
     *     summary="Return list of user reservations",
     *     description="Return list of user reservations",
     *     operationId="get-user-reservations",
     *     tags={"reservations"},
     *     @OA\Response(
     *         response=200,
     *         description="List of reservations",
     *         @OA\JsonContent(
     *             required={"data", "links", "meta"},
     *             @OA\Property(property="data", type="object", ref="#/components/schemas/ReservationResource"),
     *             @OA\Property(property="links", type="object", ref="#/components/schemas/links"),
     *             @OA\Property(property="meta", type="object", ref="#/components/schemas/meta")
     *         )
     *     ),
     *     @OA\Response(
     *        response="401",
     *        ref="#/components/responses/unauthenticated"
     *     ),
     *     @OA\Response(
     *        response="403",
     *        ref="#/components/responses/unauthorized"
     *     ),
     *     @OA\Response(
     *        response="500",
     *        ref="#/components/responses/error"
     *     )
     * )
     */
    public function getUserReservationsList(ReservationGetterInterface $getter): AnonymousResourceCollection
    {
        $reservations = $getter->paginateLoggedUserReservations();

        return ReservationResource::collection($reservations);
    }

    /**
     * @OA\Post (
     *     path="/api/reservations",
     *     summary="Place new reservation",
     *     description="Place new reservation",
     *     operationId="post-reservation",
     *     tags={"reservations"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Reservation data",
     *         @OA\JsonContent(
     *             required={"date_from", "date_to"},
     *             @OA\Property(property="date_from", type="string", format="date", example="2024-06-01", nullable=false),
     *             @OA\Property(property="date_to", type="string", format="date", example="2024-06-01", nullable=false),
     *             @OA\Property(property="asset_id", type="string", format="uuid", example="7d20ed5d-9d6c-3bcb-9fa6-75d659abfa7a", nullable=true),
     *         )
     *     ),
     *     @OA\Response(
     *        response="201",
     *        ref="#/components/responses/created"
     *     ),
     *     @OA\Response(
     *        response="401",
     *        ref="#/components/responses/unauthenticated"
     *     ),
     *     @OA\Response(
     *        response="403",
     *        ref="#/components/responses/unauthorized"
     *     ),
     *     @OA\Response(
     *        response="409",
     *        ref="#/components/responses/conflict"
     *     ),
     *     @OA\Response(
     *        response="422",
     *        ref="#/components/responses/unprocessable-entity"
     *     ),
     *     @OA\Response(
     *        response="500",
     *        ref="#/components/responses/error"
     *     ),
     * )
     *
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
