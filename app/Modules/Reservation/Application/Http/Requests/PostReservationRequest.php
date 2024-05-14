<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Application\Http\Requests;

use Ramsey\Uuid\UuidInterface;
use Spatie\LaravelData\Attributes\Validation\Date;
use Spatie\LaravelData\Data;

final class PostReservationRequest extends Data
{
    public function __construct(
        #[Date]
        public string $date_from,

        #[Date]
        public string $date_to,

        public ?UuidInterface $asset_id = null,
    ) {
    }
}
