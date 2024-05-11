<?php

declare(strict_types=1);

namespace App\Modules\Reservation;

use App\Modules\Vacant\Vacant;
use App\Shared\Casts\Model\UuidModelCast;
use Database\Factories\ReservationFactory;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @mixin IdeHelperReservation
 */
final class Reservation extends Model
{
    use HasUuids;
    use HasFactory;
    use HasTimestamps;

    protected $fillable = [
        'date_from',
        'date_to',
    ];

    protected $casts = [
        'id' => UuidModelCast::class,
    ];

    protected static function newFactory(): ReservationFactory
    {
        return ReservationFactory::new();
    }

    /**
     * @return BelongsToMany<Vacant>
     */
    public function vacants(): BelongsToMany
    {
        return $this->belongsToMany(Vacant::class);
    }
}
