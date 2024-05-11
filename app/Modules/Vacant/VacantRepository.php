<?php

declare(strict_types=1);

namespace App\Modules\Vacant;

use Illuminate\Support\Collection;

final readonly class VacantRepository
{
    public function __construct(private Vacant $model)
    {
    }

    public function getByDates(array $dates): Collection
    {
        return $this->model->whereIn('date', $dates)->get();
    }
}
