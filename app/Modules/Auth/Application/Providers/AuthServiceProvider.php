<?php

declare(strict_types=1);

namespace App\Modules\Auth\Application\Providers;

use App\Modules\Auth\Domain\Contracts\AuthServiceInterface;
use App\Modules\Auth\Domain\Services\AuthService;
use Illuminate\Support\ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    public array $bindings = [
        // ports that are driving core
        AuthServiceInterface::class => AuthService::class,
    ];
}
