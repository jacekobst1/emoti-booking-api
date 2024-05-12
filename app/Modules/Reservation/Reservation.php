<?php

declare(strict_types=1);

namespace App\Modules\Reservation;

use App\Modules\User\User;
use App\Modules\Vacant\Vacant;
use App\Shared\Casts\Model\UuidModelCast;
use Carbon\Carbon;
use Database\Factories\ReservationFactory;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
     * @return BelongsTo<User>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsToMany<Vacant>
     */
    public function vacancies(): BelongsToMany
    {
        return $this->belongsToMany(Vacant::class);
    }

    public function getNumberOfNights(): float
    {
        return (int)Carbon::parse($this->date_from)->diffInDays($this->date_to);
    }
}
