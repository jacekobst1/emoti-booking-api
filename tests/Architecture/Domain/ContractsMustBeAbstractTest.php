<?php

declare(strict_types=1);

describe('Every class in ...\Domain\Contracts directory must be abstract', function () {
    arch('Auth')
        ->expect('App\Modules\Auth\Domain\Contracts')
        ->toBeInterfaces()
        ->ignoring('App\Modules\Auth\Domain\Contracts\DataTransferObjects');

    arch('Reservations')
        ->expect('App\Modules\Reservation\Domain\Contracts')
        ->toBeInterfaces()
        ->ignoring('App\App\Modules\Reservation\Domain\Contracts\DataTransferObjects');

    arch('Slots')
        ->expect('App\Modules\Slot\Domain\Contracts')
        ->toBeInterfaces()
        ->ignoring('App\Modules\Slot\Domain\Contracts\DataTransferObjects');
});
