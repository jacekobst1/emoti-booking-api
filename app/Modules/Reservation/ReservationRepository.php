<?php

declare(strict_types=1);

namespace App\Modules\Reservation;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final readonly class ReservationRepository
{
    public function __construct(private Reservation $model)
    {
    }

    /**
     * @return LengthAwarePaginator<Reservation>
     */
    public function sortByDatesAndPaginate(): LengthAwarePaginator
    {
        return $this->model
            ->orderBy('date_from')
            ->orderBy('date_to')
            ->paginate();
    }
}
