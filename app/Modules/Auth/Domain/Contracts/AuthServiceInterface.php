<?php

declare(strict_types=1);

namespace App\Modules\Auth\Domain\Contracts;

use App\Modules\Auth\Domain\Contracts\DataTransferObjects\UserDto;
use Ramsey\Uuid\UuidInterface;

interface AuthServiceInterface
{
    public function getLoggedUserId(): ?UuidInterface;

    public function getLoggedUser(): ?UserDto;
}
