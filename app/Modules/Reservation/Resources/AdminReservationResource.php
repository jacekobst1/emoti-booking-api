<?php

namespace App\Modules\Reservation\Resources;

use App\Modules\Reservation\Reservation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Reservation
 */
class AdminReservationResource extends JsonResource
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
            'user_id' => $this->user_id,
            'date_from' => $this->date_from,
            'date_to' => $this->date_to,
            'total_price' => $this->total_price,
            'number_of_nights' => $this->getNumberOfNights(),
            'created_at' => $this->created_at?->toDateString(),
            'updated_at' => $this->updated_at?->toDateString(),
        ];
    }
}
