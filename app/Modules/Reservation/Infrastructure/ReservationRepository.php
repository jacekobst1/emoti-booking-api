<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Infrastructure;

use App\Modules\Reservation\Domain\Contracts\ReservationRepositoryInterface;
use App\Modules\Reservation\Domain\Models\Reservation;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Ramsey\Uuid\UuidInterface;

final readonly class ReservationRepository implements ReservationRepositoryInterface
{
    public function __construct(private Reservation $model)
    {
    }

    /**
     * @return LengthAwarePaginator<Reservation>
     */
    public function paginateUserReservations(UuidInterface $userId): LengthAwarePaginator
    {
        return $this->model
            ->where('user_id', $userId->toString())
            ->orderBy('date_from')
            ->orderBy('date_to')
            ->paginate();
    }

    /**
     * @return LengthAwarePaginator<Reservation>
     */
    public function paginateAdminReservations(): LengthAwarePaginator
    {
        return $this->model
            ->orderBy('date_from')
            ->orderBy('date_to')
            ->paginate();
    }
}
