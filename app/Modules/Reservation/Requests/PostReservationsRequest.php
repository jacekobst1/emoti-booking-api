<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Requests;

use Spatie\LaravelData\Attributes\Validation\Date;
use Spatie\LaravelData\Data;

final class PostReservationsRequest extends Data
{
    public function __construct(
        #[Date]
        public string $date_from,

        #[Date]
        public string $date_to,
    ) {
    }
}