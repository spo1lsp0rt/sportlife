<?php

namespace App\Http\Controllers;
use App\Models\Result;
use App\Models\Test;

/**
 * Вывод результата выполнения теста
*/
class TestResultController extends Controller
{
    /**
     * Точка входа в контроллер
     *
     * @param int $id Идентификатор результата теста
     *
     * @return \Illuminate\Contracts\View\View
    */
    public function __invoke(int $id)
    {
        $result = Result::with('Exercises')->findOrFail($id);

        return view('test_result', [
            "id" => $id,
            "result" => $result,
        ]);
    }
}
