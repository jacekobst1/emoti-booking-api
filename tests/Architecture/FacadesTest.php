<?php

declare(strict_types=1);

test('Facades should not be used - use DI instead')
    ->expect('Illuminate\Support\Facades')
    ->not->toBeUsed()
    ->ignoring([
        'Database\Seeders',
        'Database\Factories',

        'App\Providers\TelescopeServiceProvider',
        'App\Providers\FortifyServiceProvider',
        'App\Actions\Fortify\CreateNewUser',
        'App\Actions\Fortify\ResetUserPassword',
        'App\Actions\Fortify\UpdateUserPassword',
        'App\Actions\Fortify\UpdateUserProfileInformation',

        'Illuminate\Support\Facades\DB',
    ]);
