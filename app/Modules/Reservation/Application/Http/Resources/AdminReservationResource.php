<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Application\Http\Resources;

use App\Modules\Reservation\Domain\Models\Reservation;
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
