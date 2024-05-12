<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{use AllowDynamicProperties;use App\Modules\User\User;use Database\Factories\UserFactory;use Eloquent;use Illuminate\Database\Eloquent\Builder;use Illuminate\Notifications\DatabaseNotification;use Illuminate\Notifications\DatabaseNotificationCollection;use Illuminate\Support\Carbon;
/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static UserFactory factory($count = null, $state = [])
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @mixin Eloquent
 */
	#[AllowDynamicProperties]
	class IdeHelperUser {}
}

namespace App\Modules\Reservation{use AllowDynamicProperties;use App\Modules\Vacant\Vacant;use Database\Factories\ReservationFactory;use Eloquent;use Illuminate\Database\Eloquent\Builder;use Illuminate\Database\Eloquent\Collection;use Illuminate\Support\Carbon;use Ramsey\Uuid\UuidInterface;
/**
 *
 *
 * @property UuidInterface $id
 * @property string $date_from
 * @property string $date_to
 * @property int $total_price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Vacant> $vacancies
 * @property-read int|null $vacancies_count
 * @method static ReservationFactory factory($count = null, $state = [])
 * @method static Builder|Reservation newModelQuery()
 * @method static Builder|Reservation newQuery()
 * @method static Builder|Reservation query()
 * @method static Builder|Reservation whereCreatedAt($value)
 * @method static Builder|Reservation whereDateFrom($value)
 * @method static Builder|Reservation whereDateTo($value)
 * @method static Builder|Reservation whereId($value)
 * @method static Builder|Reservation whereTotalPrice($value)
 * @method static Builder|Reservation whereUpdatedAt($value)
 * @mixin Eloquent
 */
	#[AllowDynamicProperties]
	final class IdeHelperReservation {}
}

namespace App\Modules\Vacant{use AllowDynamicProperties;use App\Modules\Reservation\Reservation;use Database\Factories\VacantFactory;use Eloquent;use Illuminate\Database\Eloquent\Builder;use Illuminate\Database\Eloquent\Collection;use Illuminate\Support\Carbon;use Ramsey\Uuid\UuidInterface;
/**
 *
 *
 * @property UuidInterface $id
 * @property string $date
 * @property int $number_of_beds
 * @property int $price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Reservation> $reservations
 * @property-read int|null $reservations_count
 * @method static VacantFactory factory($count = null, $state = [])
 * @method static Builder|Vacant newModelQuery()
 * @method static Builder|Vacant newQuery()
 * @method static Builder|Vacant query()
 * @method static Builder|Vacant whereCreatedAt($value)
 * @method static Builder|Vacant whereDate($value)
 * @method static Builder|Vacant whereId($value)
 * @method static Builder|Vacant whereNumberOfBeds($value)
 * @method static Builder|Vacant wherePrice($value)
 * @method static Builder|Vacant whereUpdatedAt($value)
 * @mixin Eloquent
 */
	#[AllowDynamicProperties]
	class IdeHelperVacant {}
}

