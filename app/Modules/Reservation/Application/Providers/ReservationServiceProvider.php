<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Application\Providers;

use App\Modules\Reservation\Domain\Interfaces\ReservationCreatorInterface;
use App\Modules\Reservation\Domain\Services\ReservationCreator;
use Illuminate\Support\ServiceProvider;


class ReservationServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        ReservationCreatorInterface::class => ReservationCreator::class,
    ];
}
