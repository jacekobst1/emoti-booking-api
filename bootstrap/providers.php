<?php

declare(strict_types=1);

return [
    /**
     * App
     */
    App\Providers\AppServiceProvider::class,

    /**
     * Packages
     */
    App\Providers\FortifyServiceProvider::class,

    /**
     * Modules
     */
    App\Modules\Reservation\Application\Providers\ReservationServiceProvider::class,
    App\Modules\Slot\Application\Providers\SlotServiceProvider::class,
    App\Modules\Auth\Application\Providers\AuthServiceProvider::class,
];
