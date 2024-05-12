<?php

declare(strict_types=1);

namespace Tests\Helpers;

use App\Modules\User\User;
use Laravel\Sanctum\Sanctum;

trait SanctumTrait
{
    private User $loggedUser;

    private function actAsUser(): void
    {
        $this->seed();

        $user = User::whereEmail('user@gmail.com')->first();

        Sanctum::actingAs($user);
        $this->loggedUser = $user;
    }

    private function actAsAdmin(): void
    {
        $this->seed();

        $admin = User::whereEmail('admin@gmail.com')->first();

        Sanctum::actingAs($admin);
        $this->loggedUser = $admin;
    }
}
