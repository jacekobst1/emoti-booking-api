<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Domain\Services;

use App\Modules\Asset\Domain\Models\Asset;
use App\Modules\Reservation\Domain\Interfaces\ReservationCreatorInterface;
use App\Modules\Reservation\Domain\Models\Reservation;

final class ReservationCreator implements ReservationCreatorInterface
{
    public function __construct()
    {
    }

    /**
     * @param array{
     *     date_from: string,
     *     date_to: string,
     * } $data
     */
    public function handle(array $data): Reservation
    {
        $asset = Asset::factory()->create();
        
        return Reservation::factory()->for($asset)->create();
    }
}
