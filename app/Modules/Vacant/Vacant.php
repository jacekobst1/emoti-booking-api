<?php

declare(strict_types=1);

namespace App\Modules\Vacant;

use App\Modules\Reservation\Reservation;
use App\Shared\Casts\Model\UuidModelCast;
use Database\Factories\VacantFactory;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @mixin IdeHelperVacant
 */
class Vacant extends Model
{
    use HasUuids;
    use HasFactory;
    use HasTimestamps;

    protected $table = 'vacancies';

    protected $fillable = [
        'date',
        'number_of_beds',
        'price',
    ];

    protected $casts = [
        'id' => UuidModelCast::class,
    ];

    protected static function newFactory(): VacantFactory
    {
        return VacantFactory::new();
    }

    /**
     * @return BelongsToMany<Reservation>
     */
    public function reservations(): BelongsToMany
    {
        return $this->belongsToMany(Reservation::class);
    }

    public function bedsAreAvailable(): bool
    {
        return $this->number_of_beds - $this->reservations()->count() > 0;
    }
}
