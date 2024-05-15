<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Domain\Services;

use App\Modules\Reservation\Domain\Contracts\ReservationDestroyerInterface;
use App\Modules\Reservation\Domain\Contracts\ReservationModelManagerInterface;
use App\Modules\Reservation\Domain\Models\Reservation;

final readonly class ReservationDestroyer implements ReservationDestroyerInterface
{
    public function __construct(
        private ReservationModelManagerInterface $modelManager
    ) {
    }

    public function delete(Reservation $reservation): void
    {
        $this->modelManager->delete($reservation);
    }
}
