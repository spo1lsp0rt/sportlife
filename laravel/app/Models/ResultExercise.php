<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


/* Упражнение на момент сохранения результата */
/**
 * App\Models\ResultExercise
 *
 * @property int $ID_Result_Exercise
 * @property int $ID_Result
 * @property string $Name
 * @property string $Description
 * @property int|null $ID_Exercise
 * @property string $Value
 * @method static \Illuminate\Database\Eloquent\Builder|ResultExercise newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ResultExercise newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ResultExercise query()
 * @method static \Illuminate\Database\Eloquent\Builder|ResultExercise whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResultExercise whereIDExercise($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResultExercise whereIDResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResultExercise whereIDResultExercise($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResultExercise whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResultExercise whereValue($value)
 * @mixin \Eloquent
 */
class ResultExercise extends Model
{
    /*Отключает встроенное поведение в полях даты обновления записи*/
    public $timestamps = false;
    use HasFactory;
    /* Название таблицы в БД */
    protected $table = "result_exercises";
    /*Название первичного ключа в таблице*/
    protected $primaryKey = "ID_Result_Exercise";

}
