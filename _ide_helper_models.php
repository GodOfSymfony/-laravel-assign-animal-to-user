<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Animal
 *
 * @property int $id
 * @property string $title Kind of animal
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Animal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Animal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Animal query()
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereUpdatedAt($value)
 */
	class Animal extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AnimalUser
 *
 * @property int $id
 * @property int $animal_id
 * @property int $user_id
 * @property int $sleep Sleep property, max 100 points
 * @property int $hunger Hunger property, max 100 points
 * @property int $care Care property, max 100 points
 * @property int $alive Is animal alive?
 * @property string $sleep_increment_at Property updated timestamp
 * @property string $hunger_increment_at Property updated timestamp
 * @property string $care_increment_at Property updated timestamp
 * @property string $sleep_decrement_at Property updated timestamp
 * @property string $hunger_decrement_at Property updated timestamp
 * @property string $care_decrement_at Property updated timestamp
 * @method static \Illuminate\Database\Eloquent\Builder|AnimalUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AnimalUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AnimalUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|AnimalUser whereAlive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnimalUser whereAnimalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnimalUser whereCare($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnimalUser whereCareDecrementAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnimalUser whereCareIncrementAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnimalUser whereHunger($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnimalUser whereHungerDecrementAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnimalUser whereHungerIncrementAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnimalUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnimalUser whereSleep($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnimalUser whereSleepDecrementAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnimalUser whereSleepIncrementAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnimalUser whereUserId($value)
 */
	class AnimalUser extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Animal[] $animals
 * @property-read int|null $animals_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

