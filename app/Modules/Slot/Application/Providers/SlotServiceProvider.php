<?php

declare(strict_types=1);

namespace App\Modules\Slot\Application\Providers;

use App\Modules\Slot\Domain\Contracts\DataTransferObjects\SlotGetter;
use App\Modules\Slot\Domain\Contracts\SlotGetterInterface;
use App\Modules\Slot\Domain\Contracts\SlotRepositoryInterface;
use App\Modules\Slot\Infrastructure\SlotRepository;
use Illuminate\Support\ServiceProvider;


class SlotServiceProvider extends ServiceProvider
{
    public array $bindings = [
        SlotGetterInterface::class => SlotGetter::class,
        SlotRepositoryInterface::class => SlotRepository::class
    ];
}
