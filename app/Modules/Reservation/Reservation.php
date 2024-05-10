<?php

declare(strict_types=1);

namespace App\Modules\Reservation;

use App\Modules\Vacant\Vacant;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class Reservation extends Model
{
    use HasUuids;
    use HasFactory;
    use HasTimestamps;

    public $fillable = [
        'date_from',
        'date_to',
    ];

    /**
     * @return BelongsToMany<Vacant>
     */
    public function vacants(): BelongsToMany
    {
        return $this->belongsToMany(Vacant::class);
    }
}
