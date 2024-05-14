<?php

declare(strict_types=1);

describe('Domain classes cannot be dependent of external layers', function () {
    $modules = ['Auth', 'Asset', 'Reservations', 'Slots'];
    $externalLayers = ['Application', 'Infrastructure'];

    foreach ($modules as $mainModule) {
        foreach ($modules as $otherModule) {
            foreach ($externalLayers as $layer) {
                arch("$mainModule is not dependent of $otherModule $layer" . \Illuminate\Support\Str::random())
                    ->expect("App\Modules\\$mainModule\Domain")
                    ->not()->toUse("App\Modules\\$otherModule\\$layer");
            }
        }
    }
});
