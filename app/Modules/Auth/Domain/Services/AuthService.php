<?php

declare(strict_types=1);

namespace App\Modules\Auth\Domain\Services;

use App\Modules\Auth\Domain\Contracts\AuthServiceInterface;
use Illuminate\Auth\AuthManager;
use Ramsey\Uuid\UuidInterface;

final readonly class AuthService implements AuthServiceInterface
{
    public function __construct(private AuthManager $authManager)
    {
    }

    public function getLoggedUserId(): UuidInterface
    {
        /** @var UuidInterface */
        return $this->authManager->id();
    }
}
