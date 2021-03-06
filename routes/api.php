<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::post('login', [AuthController::class,'login'])->name('login');
Route::post('refresh', [AuthController::class,'refresh']);

Route::group([
    'middleware' => 'auth.jwt',
    'prefix' => 'auth'

], function ($router) {
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('me', [AuthController::class,'me']);
    Route::resource('cursos',CursoController::class);
    Route::resource('autores',CursoController::class);
});



Route::resource('cursos',CursoController::class)->only('index','show');

Route::post('home-votar',[HomeController::class,'votar']);

