<?php

declare(strict_types=1);

namespace Tests\Helpers;

use App\Models\User;
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
}
