<?php

declare(strict_types=1);

namespace App\Modules\Reservation;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final readonly class ReservationRepository
{
    public function __construct(private Reservation $model)
    {
    }

    public function paginate(): LengthAwarePaginator
    {
        return $this->model->paginate();
    }
}
