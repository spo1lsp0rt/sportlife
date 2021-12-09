<?php

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

Route::get('/authorization', [ MainController::class, 'authorization' ]);

Route::get('/tests', [ MainController::class, 'tests' ]);

Route::get('/tests', [ MainController::class, 'testform' ]);

Route::get('/about', [ MainController::class, 'about' ]);

Route::get('/test1', [ MainController::class, 'test1' ]);

Route::get('/test2', [ MainController::class, 'test2' ]);

Route::post('/test1/check', [ MainController::class, 'test1_check' ]);
