<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Application\Providers;

use App\Modules\Reservation\Domain\Contracts\ReservationCreatorInterface;
use App\Modules\Reservation\Domain\Contracts\ReservationModelManagerInterface;
use App\Modules\Reservation\Domain\Services\ReservationCreator;
use App\Modules\Reservation\Infrastructure\ReservationModelManager;
use Illuminate\Support\ServiceProvider;


class ReservationServiceProvider extends ServiceProvider
{
    public array $bindings = [
        ReservationCreatorInterface::class => ReservationCreator::class,
        ReservationModelManagerInterface::class => ReservationModelManager::class,
    ];
}
