<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


/* Результат теста */
/**
 * App\Models\Result
 *
 * @property int $ID_Result
 * @property int $ID_Test
 * @property string $Date
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ResultExercise[] $Exercises
 * @property-read int|null $exercises_count
 * @method static \Illuminate\Database\Eloquent\Builder|Result newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Result newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Result query()
 * @method static \Illuminate\Database\Eloquent\Builder|Result whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Result whereIDResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Result whereIDTest($value)
 * @mixin \Eloquent
 */
class Result extends Model
{
    /*Отключает встроенное поведение в полях даты обновления записи*/
    public $timestamps = false;
    use HasFactory;
    /* Название таблицы в БД */
    protected $table = "results";
    /*Название первичного ключа в таблице*/
    protected $primaryKey = "ID_Result";

    /**
     * Связь с упражнениями на момент сохранения результата
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Exercises():HasMany{
        return $this->hasMany(ResultExercise::class, 'ID_Result', 'ID_Result');
    }
}
