<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Application\Providers;

use App\Modules\Reservation\Domain\Contracts\ReservationCreatorInterface;
use App\Modules\Reservation\Domain\Contracts\ReservationGetterInterface;
use App\Modules\Reservation\Domain\Contracts\ReservationModelManagerInterface;
use App\Modules\Reservation\Domain\Contracts\ReservationRepositoryInterface;
use App\Modules\Reservation\Domain\Contracts\SlotsFinderFactoryInterface;
use App\Modules\Reservation\Domain\Services\ReservationCreator;
use App\Modules\Reservation\Domain\Services\ReservationGetter;
use App\Modules\Reservation\Domain\Services\SlotsFinder\SlotsFinderFactory;
use App\Modules\Reservation\Infrastructure\ReservationModelManager;
use App\Modules\Reservation\Infrastructure\ReservationRepository;
use Illuminate\Support\ServiceProvider;


class ReservationServiceProvider extends ServiceProvider
{
    /**
     * @var array<class-string, class-string> $bindings
     */
    public array $bindings = [
        // ports driven by core
        ReservationRepositoryInterface::class => ReservationRepository::class,
        ReservationModelManagerInterface::class => ReservationModelManager::class,

        // ports that are driving core
        ReservationGetterInterface::class => ReservationGetter::class,
        ReservationCreatorInterface::class => ReservationCreator::class,

        // core inner dependencies
        SlotsFinderFactoryInterface::class => SlotsFinderFactory::class,
    ];
}
