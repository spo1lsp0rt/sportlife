<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
 * @mixin \Eloquent
 */
class statistic extends Model
{
    use HasFactory;
    protected $table = "statistic";
    public $timestamps = false;
    protected $primaryKey = "ID_Statistic";
}
