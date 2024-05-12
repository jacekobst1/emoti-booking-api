<?php

declare(strict_types=1);

namespace App\Modules\Vacant;

use Illuminate\Support\Collection;

final readonly class VacantRepository
{
    public function __construct(private Vacant $model)
    {
    }

    /**
     * @param non-empty-list<non-empty-string> $dates
     *
     * @return Collection<int, Vacant>
     */
    public function getByDates(array $dates): Collection
    {
        return $this->model->whereIn('date', $dates)->get();
    }
}
