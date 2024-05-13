<?php

declare(strict_types=1);

namespace App\Modules\Auth\Domain\Contracts;

use Ramsey\Uuid\UuidInterface;

interface AuthServiceInterface
{
    public function getLoggedUserId(): UuidInterface;
}
