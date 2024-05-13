<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Application\Http\Resources;

use App\Modules\Reservation\Domain\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="ReservationResource",
 *     required={"id", "asset_id", "date_from", "date_to", "total_price", "number_of_nights", "created_at", "updated_at"},
 *     @OA\Property(property="id", type="string", format="uuid", example="ae6fc2f0-0676-11ec-b4e8-07f02bffb055", nullable=false),
 *     @OA\Property(property="asset_id", type="string", format="uuid", example="04407850-0677-11ec-a982-4b6482ec6470", nullable=false),
 *     @OA\Property(property="date_from", type="string", format="date", example="2024-06-01", nullable=false),
 *     @OA\Property(property="date_to", type="string", format="date", example="2024-06-01", nullable=false),
 *     @OA\Property(property="total_price", type="integer", example="1800", nullable=false, description="Total price in grosze"),
 *     @OA\Property(property="number_of_nights", type="integer", example="1", nullable=false),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-05-13 14:26:28", nullable=true),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-05-13 14:26:28", nullable=true),
 * )
 *
 * @mixin Reservation
 */
class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'asset_id' => $this->asset_id,
            'date_from' => $this->date_from,
            'date_to' => $this->date_to,
            'total_price' => $this->total_price,
            'number_of_nights' => $this->getNumberOfNights(),
            'created_at' => $this->created_at?->toDateString(),
            'updated_at' => $this->updated_at?->toDateString(),
        ];
    }
}
