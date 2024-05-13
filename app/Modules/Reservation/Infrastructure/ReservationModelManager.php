<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Infrastructure;

use App\Modules\Reservation\Domain\Contracts\ReservationModelManagerInterface;
use App\Modules\Reservation\Domain\Models\Reservation;

final class ReservationModelManager implements ReservationModelManagerInterface
{
    public function save(Reservation $model): void
    {
        $model->save();
    }
}
