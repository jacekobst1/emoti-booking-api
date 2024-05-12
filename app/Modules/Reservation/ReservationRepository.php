<?php

declare(strict_types=1);

namespace App\Modules\Reservation;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Ramsey\Uuid\UuidInterface;

final readonly class ReservationRepository
{
    public function __construct(private Reservation $model)
    {
    }

    /**
     * @return LengthAwarePaginator<Reservation>
     */
    public function sortByDatesAndPaginateByUser(?UuidInterface $userId = null): LengthAwarePaginator
    {
        $query = $this->model
            ->orderBy('date_from')
            ->orderBy('date_to');

        if ($userId !== null) {
            $query->where('user_id', $userId->toString());
        }

        return $query->paginate();
    }
}
