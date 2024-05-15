<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Infrastructure;

use App\Modules\Reservation\Domain\Contracts\ReservationModelManagerInterface;
use App\Modules\Reservation\Domain\Models\Reservation;

final class ReservationModelManager implements ReservationModelManagerInterface
{
    /**
     * @param array{non-empty-string, mixed} $properties
     */
    public function newInstance(array $properties = []): Reservation
    {
        return new Reservation($properties);
    }

    public function save(Reservation $model): void
    {
        $model->save();
    }

    public function delete(Reservation $model): void
    {
        $model->delete();
    }
}
