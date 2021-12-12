<?php

namespace App\Http\Controllers;
use App\Models\Test;

/**
 * Вывод списка тестов пользователю
*/
class TestListController extends Controller
{
    /**
     * Точка входа в контроллер
     *
     * @return \Illuminate\Contracts\View\View
    */
    public function __invoke()
    {
        return view('tests', [
            "tests" => Test::get(),
        ]);
    }
}
