<?php

declare(strict_types=1);

namespace App\Shared\Casts\Model;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @implements CastsAttributes<?UuidInterface, string>
 */
class UuidModelCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param array<string, mixed> $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): ?UuidInterface
    {
        return $value ? Uuid::fromString($value) : null;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param array<string, mixed> $attributes
     * @return non-empty-array<string, mixed>
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): array
    {
        return [$key => $value];
    }
}
