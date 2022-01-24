<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


/* Тесты в базе */
/**
 * App\Models\Test
 *
 * @property int $ID_Test
 * @property string $Name
 * @property string $Description
 * @property string $PathToHtml
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Exercise[] $Exercises
 * @property-read int|null $exercises_count
 * @method static \Illuminate\Database\Eloquent\Builder|Test newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Test newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Test query()
 * @method static \Illuminate\Database\Eloquent\Builder|Test whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Test whereIDTest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Test whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Test wherePathToHtml($value)
 * @mixin \Eloquent
 */
class Test extends Model
{
    /*Отключает встроенное поведение в полях даты обновления записи*/
    public $timestamps = false;
    use HasFactory;
    /* Название таблицы в БД */
    protected $table = "tests";
    /*Название первичного ключа в таблице*/
    protected $primaryKey = "ID_Test";

    /**
     * Связь с упражнениями
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Exercises():HasMany{
        return $this->hasMany(Exercise::class, 'ID_Test', 'ID_Test');
    }

}
