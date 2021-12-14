<?php

use App\Http\Controllers\SaveResultController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TestListController;
use App\Http\Controllers\TestResultController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ MainController::class, 'home' ]);

Route::get('/exit', [ MainController::class, 'exit' ]);

Route::get('/user_profile', [ MainController::class, 'user_profile' ]);

Route::get('/user_profile', [ MainController::class, 'statistic_table' ]);

Route::get('/authorization', [ MainController::class, 'authorization' ]);

Route::post('/auth/check', [ MainController::class, 'auth_check' ]);

Route::get('/privacy', [ MainController::class, 'privacy_policy' ]);

/*Route::get('/tests', [ MainController::class, 'tests' ]);*/

/**
 * Вывод списка тестов
 */
Route::get('/tests',  TestListController::class );

Route::get('/about', [ MainController::class, 'about' ]);

/**
 * Вывод списка заданий теста пользователю
 */
Route::get('/test/{id}',  TestController::class ) ->whereNumber('id');

/**
 * Сохранение результатов теста, вводимых пользователем значений
 *
 */
Route::post('/test/{id}',  SaveResultController::class ) ->whereNumber('id');

/**
 * Вывод результата выполнения теста
 */
Route::get('/test_result/{id}',  TestResultController::class ) ->whereNumber('id');


Route::post('/test1_result', [ MainController::class, 'test1_result' ]);
