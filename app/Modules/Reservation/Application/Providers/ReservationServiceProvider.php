<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Application\Providers;

use App\Modules\Reservation\Domain\Contracts\ReservationCreatorInterface;
use App\Modules\Reservation\Domain\Services\ReservationCreator;
use Illuminate\Support\ServiceProvider;


class ReservationServiceProvider extends ServiceProvider
{
    public array $bindings = [
        ReservationCreatorInterface::class => ReservationCreator::class,
    ];
}
