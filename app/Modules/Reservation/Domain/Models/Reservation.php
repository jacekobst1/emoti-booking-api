<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Domain\Models;

use App\Modules\Asset\Domain\Models\Asset;
use App\Modules\Auth\Domain\Models\User;
use App\Modules\Slot\Domain\Models\Slot;
use App\Shared\Casts\Model\UuidModelCast;
use Carbon\Carbon;
use Database\Factories\ReservationFactory;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'user_id' => UuidModelCast::class,
        'asset_id' => UuidModelCast::class,
    ];

    protected static function newFactory(): ReservationFactory
    {
        return ReservationFactory::new();
    }

    /**
     * @return BelongsTo<User, Reservation>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<Asset, Reservation>
     */
    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }

    /**
     * @return HasMany<Slot>
     */
    public function slots(): HasMany
    {
        return $this->hasMany(Slot::class);
    }

    public function getNumberOfNights(): float
    {
        return (int)Carbon::parse($this->date_from)->diffInDays($this->date_to);
    }
}
