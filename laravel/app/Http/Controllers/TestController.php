<?php

namespace App\Http\Controllers;
use App\Models\Test;

/**
 * Вывод списка заданий теста пользователю
*/
class TestController extends Controller
{
    /**
     * Точка входа в контроллер
     *
     * @param int $id Идентификатор теста
     *
     * @return \Illuminate\Contracts\View\View
    */
    public function __invoke(int $id)
    {
        return view('test', [
            "id" => $id,
            "test" => Test::with('Exercises')->findOrFail($id),
        ]);
    }
}
