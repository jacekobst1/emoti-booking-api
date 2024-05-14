<?php

declare(strict_types=1);

namespace App\Modules\Slot\Application\Providers;

use App\Modules\Slot\Domain\Contracts\SlotGetterInterface;
use App\Modules\Slot\Domain\Contracts\SlotModelManagerInterface;
use App\Modules\Slot\Domain\Contracts\SlotRepositoryInterface;
use App\Modules\Slot\Domain\Contracts\SlotReserverInterface;
use App\Modules\Slot\Domain\Services\SlotGetter;
use App\Modules\Slot\Domain\Services\SlotReserver;
use App\Modules\Slot\Infrastructure\SlotModelManager;
use App\Modules\Slot\Infrastructure\SlotRepository;
use Illuminate\Support\ServiceProvider;


class SlotServiceProvider extends ServiceProvider
{
    /**
     * @var array<class-string, class-string> $bindings
     */
    public array $bindings = [
        // ports driven by core
        SlotRepositoryInterface::class => SlotRepository::class,
        SlotModelManagerInterface::class => SlotModelManager::class,

        // ports that are driving core
        SlotGetterInterface::class => SlotGetter::class,
        SlotReserverInterface::class => SlotReserver::class,
    ];
}
