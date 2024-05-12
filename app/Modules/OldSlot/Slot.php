<?php

declare(strict_types=1);

namespace App\Modules\OldSlot;

use App\Modules\OldAsset\Asset;
use App\Modules\OldAsset\IdeHelperVacant;
use App\Modules\OldReservation\Reservation;
use App\Shared\Casts\Model\UuidModelCast;
use Database\Factories\AssetFactory;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperSlot
 */
class Slot extends Model
{
    use HasUuids;
    use HasFactory;
    use HasTimestamps;

    protected $fillable = [
        'date',
        'price',
    ];

    protected $casts = [
        'id' => UuidModelCast::class,
    ];

    protected static function newFactory(): AssetFactory
    {
        return AssetFactory::new();
    }

    /**
     * @return BelongsTo<Asset>
     */
    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }

    /**
     * @return BelongsTo<Reservation>
     */
    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }
}
