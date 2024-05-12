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


namespace App\Modules\Asset\Domain\Models{
/**
 * 
 *
 * @property \Ramsey\Uuid\UuidInterface $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modules\Reservation\Domain\Models\Reservation> $reservations
 * @property-read int|null $reservations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modules\Slot\Domain\Models\Slot> $slots
 * @property-read int|null $slots_count
 * @method static \Database\Factories\AssetFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Asset newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Asset newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Asset query()
 * @method static \Illuminate\Database\Eloquent\Builder|Asset whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Asset whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Asset whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Asset whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperAsset {}
}

namespace App\Modules\Auth\Models{
/**
 * 
 *
 * @property string $uuid
 * @property string $name
 * @property string $guard_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modules\Auth\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modules\User\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission withoutRole($roles, $guard = null)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperPermission {}
}

namespace App\Modules\Auth\Models{
/**
 * 
 *
 * @property string $uuid
 * @property string $name
 * @property string $guard_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modules\Auth\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modules\User\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role withoutPermission($permissions)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperRole {}
}

namespace App\Modules\OldAsset{
/**
 * 
 *
 * @property \Ramsey\Uuid\UuidInterface $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modules\Reservation\Domain\Models\Reservation> $reservations
 * @property-read int|null $reservations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modules\Slot\Domain\Models\Slot> $slots
 * @property-read int|null $slots_count
 * @method static \Database\Factories\AssetFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Asset newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Asset newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Asset query()
 * @method static \Illuminate\Database\Eloquent\Builder|Asset whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Asset whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Asset whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Asset whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperAsset {}
}

namespace App\Modules\OldReservation{
/**
 * 
 *
 * @property \Ramsey\Uuid\UuidInterface $id
 * @property string $user_id
 * @property string $asset_id
 * @property string $date_from
 * @property string $date_to
 * @property int $total_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Modules\OldAsset\Asset $asset
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modules\OldSlot\Slot> $slots
 * @property-read int|null $slots_count
 * @property-read \App\Modules\User\User $user
 * @method static \Database\Factories\ReservationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereAssetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereDateFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereDateTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	final class IdeHelperReservation {}
}

namespace App\Modules\OldSlot{
/**
 * 
 *
 * @property \Ramsey\Uuid\UuidInterface $id
 * @property string $asset_id
 * @property string|null $reservation_id
 * @property string $date
 * @property int $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Modules\OldAsset\Asset $asset
 * @property-read \App\Modules\OldReservation\Reservation|null $reservation
 * @method static \Database\Factories\AssetFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Slot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slot query()
 * @method static \Illuminate\Database\Eloquent\Builder|Slot whereAssetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slot whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slot whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slot wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slot whereReservationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slot whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperSlot {}
}

namespace App\Modules\Reservation\Domain\Models{
/**
 * 
 *
 * @property \Ramsey\Uuid\UuidInterface $id
 * @property string $user_id
 * @property string $asset_id
 * @property string $date_from
 * @property string $date_to
 * @property int $total_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Modules\OldAsset\Asset $asset
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modules\OldSlot\Slot> $slots
 * @property-read int|null $slots_count
 * @property-read \App\Modules\User\User $user
 * @method static \Database\Factories\ReservationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereAssetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereDateFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereDateTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	final class IdeHelperReservation {}
}

namespace App\Modules\Slot\Domain\Models{
/**
 * 
 *
 * @property \Ramsey\Uuid\UuidInterface $id
 * @property string $asset_id
 * @property string|null $reservation_id
 * @property string $date
 * @property int $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Modules\Asset\Domain\Models\Asset $asset
 * @property-read \App\Modules\Reservation\Domain\Models\Reservation|null $reservation
 * @method static \Database\Factories\SlotFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Slot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slot query()
 * @method static \Illuminate\Database\Eloquent\Builder|Slot whereAssetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slot whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slot whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slot wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slot whereReservationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slot whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperSlot {}
}

namespace App\Modules\User{
/**
 * 
 *
 * @property \Ramsey\Uuid\UuidInterface $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modules\Auth\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modules\Auth\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutRole($roles, $guard = null)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperUser {}
}

