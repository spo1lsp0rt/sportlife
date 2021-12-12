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
 * App\Models\Test
 *
 * @property int $ID_Test
 * @property string $Name
 * @property string $Description
 * @property string $PathToHtml
 * @method static \Illuminate\Database\Eloquent\Builder|Test newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Test newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Test query()
 * @method static \Illuminate\Database\Eloquent\Builder|Test whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Test whereIDTest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Test whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Test wherePathToHtml($value)
 */
	class Test extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\statistic
 *
 * @property int $ID_Statistic
 * @property int $ID_User
 * @property int $ID_Test
 * @property string|null $date_test
 * @property float $Result
 * @method static \Illuminate\Database\Eloquent\Builder|statistic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|statistic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|statistic query()
 * @method static \Illuminate\Database\Eloquent\Builder|statistic whereDateTest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|statistic whereIDStatistic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|statistic whereIDTest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|statistic whereIDUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|statistic whereResult($value)
 */
	class statistic extends \Eloquent {}
}

