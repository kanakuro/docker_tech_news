<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\LoginController;

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
Route::get('/index', [ApiController::class, 'getIndex'])->name('index');;
Route::get('/post_favorite', [ApiController::class, 'registFav']);
Route::get('/get_favorite', [ApiController::class, 'getFav']);
Route::get('/invalid_favorite', [ApiController::class, 'invalidFav']);
Route::get('/notify_slack', [ApiController::class, 'sendSlack']);
Route::get('/login/{create_user?}/{message?}', [LoginController::class, 'getLogin'])->name('login');
Route::post('/confirm_or_regist_user', [LoginController::class, 'confirmOrRegistUser']);

// Route::get('/', function () {
//     // return view('welcome');
// });
