<?php

declare(strict_types=1);

namespace App\Modules\Vacant;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Vacant extends Model
{
    use HasUuids;
    use HasFactory;
    use HasTimestamps;

    protected $fillable = [
        'date',
        'number_of_beds',
    ];
}
