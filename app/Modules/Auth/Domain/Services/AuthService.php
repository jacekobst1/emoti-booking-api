<?php

declare(strict_types=1);

namespace App\Modules\Auth\Domain\Services;

use App\Modules\Auth\Domain\Contracts\AuthServiceInterface;
use App\Modules\Auth\Domain\Contracts\DataTransferObjects\UserDto;
use App\Modules\Auth\Domain\Models\User;
use Illuminate\Auth\AuthManager;
use Ramsey\Uuid\UuidInterface;

final readonly class AuthService implements AuthServiceInterface
{
    public function __construct(private AuthManager $authManager)
    {
    }

    public function getLoggedUserId(): ?UuidInterface
    {
        /** @var ?UuidInterface */
        return $this->authManager->id();
    }

    public function getLoggedUser(): ?UserDto
    {
        /** @var ?User $userModel */
        $userModel = $this->authManager->user();

        return $userModel ? UserDto::fromUserModel($userModel) : null;
    }
}
