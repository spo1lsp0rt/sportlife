<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* Тесты в базе */
/**
 * App\Models\Exercise
 *
 * @property int $ID_Exercise
 * @property string $Name
 * @property string $Description
 * @property int $ID_Test
 * @method static \Illuminate\Database\Eloquent\Builder|Exercise newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Exercise newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Exercise query()
 * @method static \Illuminate\Database\Eloquent\Builder|Exercise whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercise whereIDExercise($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercise whereIDTest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercise whereName($value)
 * @mixin \Eloquent
 */
class Exercise extends Model
{
    /*Отключает встроенное поведение в полях даты обновления записи*/
    public $timestamps = false;
    use HasFactory;
    /* Название таблицы в БД */
    protected $table = "exercises";
    /*Название первичного ключа в таблице*/
    protected $primaryKey = "ID_Exercises";

    /**
     * Название поля на форме
     *
     * @return string
     */
    public function getInputName():string{
        return 'exercisevalue'.$this->ID_Exercises;
    }
}
