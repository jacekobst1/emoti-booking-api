<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Application\Policies;

use App\Modules\Auth\Domain\Models\User;
use App\Modules\Reservation\Domain\Models\Reservation;

final readonly class ReservationPolicy
{
    public const string DELETE = 'delete';

    public function delete(User $user, Reservation $reservation): bool
    {
        return $reservation->user_id->equals(
            $user->id,
        );
    }
}
