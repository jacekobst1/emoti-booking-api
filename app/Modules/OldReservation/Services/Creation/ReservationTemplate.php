<?php

declare(strict_types=1);

namespace App\Modules\OldReservation\Services\Creation;

use Ramsey\Uuid\UuidInterface;

final readonly class ReservationTemplate
{
    public function __construct(
        private string $dateFrom,
        private string $dateTo,
        private int $totalPrice,
        private UuidInterface $userId,
        private UuidInterface $assetId,
    ) {
    }
}
