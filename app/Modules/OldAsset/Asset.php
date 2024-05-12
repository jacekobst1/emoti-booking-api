<?php

declare(strict_types=1);

namespace App\Modules\OldAsset;

use App\Modules\Reservation\Domain\Models\Reservation;
use App\Modules\Slot\Domain\Models\Slot;
use App\Shared\Casts\Model\UuidModelCast;
use Database\Factories\AssetFactory;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperAsset
 */
class Asset extends Model
{
    use HasUuids;
    use HasFactory;
    use HasTimestamps;

    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'id' => UuidModelCast::class,
    ];

    protected static function newFactory(): AssetFactory
    {
        return AssetFactory::new();
    }

    /**
     * @return HasMany<Slot>
     */
    public function slots(): HasMany
    {
        return $this->hasMany(Slot::class);
    }

    /**
     * @return HasMany<Reservation>
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
