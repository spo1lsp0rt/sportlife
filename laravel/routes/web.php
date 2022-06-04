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

Route::get('/normatives', [ MainController::class, 'normatives' ]);

Route::get('/statistics', [ MainController::class, 'statistics' ]);

Route::get('/exit', [ MainController::class, 'exit' ]);

Route::get('/profile', [ MainController::class, 'profile' ]);

Route::post('/clear_statistic/{id}', [ MainController::class, 'clear_statistic' ])->whereNumber('id');

Route::get('/registration', [ MainController::class, 'registration' ]);

Route::get('/authorization', [ MainController::class, 'authorization' ]);

Route::post('/auth/check', [ MainController::class, 'auth_check' ]);

Route::post('/check_key', [ MainController::class, 'check_key' ]);

Route::post('/reg', [ MainController::class, 'reg' ]);

Route::post('/updateStudent', [ MainController::class, 'updateStudent' ]);

Route::post('/delete_student', [ MainController::class, 'delete_student' ]);

Route::post('/out_ofp', [ MainController::class, 'out_ofp' ]);

Route::post('/add_users', [ MainController::class, 'add_users' ]);

Route::get('/privacy', [ MainController::class, 'privacy_policy' ]);

Route::post('/out_ofp', [ MainController::class, 'out_ofp' ]);

Route::post('/ofp_table', [ MainController::class, 'ofp_table' ]);

Route::post('/out_testResults', [ MainController::class, 'out_testResults' ]);

/**
 * Вывод списка тестов
 */
Route::get('/tests',  TestListController::class );

Route::get('/about', [ MainController::class, 'about' ]);

Route::get('/contacts', [ MainController::class, 'contacts' ]);


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
