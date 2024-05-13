<?php

declare(strict_types=1);

namespace App\Modules\Auth\Domain\Contracts\DataTransferObjects;

use App\Modules\Auth\Domain\Models\User;

final readonly class UserDto
{
    public function __construct(
        public string $name,
        public string $email,

    ) {
    }

    public static function fromUserModel(User $user): self
    {
        return new self(
            name: $user->name,
            email: $user->email,
        );
    }
}
